<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOrderItemRequest;
use App\Interfaces\Services\UserProfileServiceInterface;
use App\Interfaces\Services\UserServiceInterface;
use App\Models\Address;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderItemPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class OrderController extends Controller
{

    private UserProfileServiceInterface $userProfileService;
    private UserServiceInterface $userService;

    public function __construct(UserProfileServiceInterface $userProfileService, UserServiceInterface $userService)
    {
        $this->userProfileService = $userProfileService;
        $this->userService = $userService;
    }

    public function index()
    {
        $orders = Order::with('items')
            ->orderByRaw("CASE WHEN status = 'not_created' THEN 0 ELSE 1 END, updated_at DESC")
            ->get();

        return view('front.orders.index', compact('orders'));
    }

    public function create()
    {
        return view('front.orders.create');
    }

    public function show(Order $order)
    {
        $order->load(['items.photos', 'user.profile.phones' => function ($query) {
            $query->where('is_active', true)->latest()->limit(1);
        }, 'address']);

        return view('front.orders.show', compact('order'));
    }

    public function export(Order $order)
    {
        return Excel::download(new OrderExport($order), 'order-' . $order->id . '.xlsx');
    }

    public function storeItem(CreateOrderItemRequest $request)
    {
        $validated = $request->validated();

        $orderId = $request->input('order_id');
        $order = Order::find($orderId) ?? new Order([
                'user_id' => auth()->id(),
                'status' => 'not_created',
            ]);
        $order->save();

        $validated['is_photo_report'] = $request->input('is_photo_report') == '1';
        $validated['is_measure'] = $request->input('is_measure') == '1';
        $validated['is_lathing'] = $request->input('is_lathing') == '1';
        $validated['is_bubble_wrap'] = $request->input('is_bubble_wrap') == '1';
        $validated['is_comment'] = $request->input('is_comment') == '1';
        $validated['total_price'] = $validated['price'] * $validated['quantity'];

        $orderItem = new OrderItem($validated);
        $order->items()->save($orderItem);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('order_items', $filename, 'public');

            OrderItemPhoto::create([
                'order_item_id' => $orderItem->id,
                'file_path' => $path,
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Позиция успешно добавлена. Заказ Сохранен в режиме черновика.',
            'data' => [
                'orderItem' => $orderItem,
                'orderId' => $order->id,
            ],
        ]);
    }


    public function getOrderItems($orderId)
    {
        $orderItems = OrderItem::where('order_id', $orderId)->get();

        return response()->json($orderItems);
    }

    public function completeOrder(Request $request)
    {
        $orderId = $request->input('order_id');
        $addressId = $request->input('address_id');

        $userProfile = $this->userProfileService->getAuthenticatedUserProfile();

        if (!$userProfile) {
            return response()->json([
                'success' => false,
                'message' => 'Профиль пользователя не найден.',
            ]);
        }

        $addressExists = Address::where('id', $addressId)
            ->where('user_profile_id', $userProfile->id)
            ->exists();

        if (!$addressExists) {
            return response()->json([
                'success' => false,
                'message' => 'Адрес не найден или не принадлежит текущему пользователю.',
            ]);
        }

        $order = Order::find($orderId);
        if (!$order) {
            return response()->json(['success' => false, 'message' => 'Заказ не найден.']);
        }

        if ($order->user_id !== $userProfile->user_id) {
            return response()->json(['success' => false, 'message' => 'Нет доступа к этому заказу.']);
        }
        $totalPrice = $order->items->sum(function ($item) {
            return $item->price * $item->quantity;
        });

        if ($totalPrice < 10000) {
            return response()->json([
                'success' => false,
                'message' => 'Сумма заказа должна быть больше 10 000.',
            ]);
        }

        $order->total_amount = $totalPrice;
        $order->address_id = $addressId;
        $order->status = 'pending';
        $order->save();

        return response()->json([
            'success' => true,
            'message' => 'Заказ успешно создан.'
        ]);
    }
}
