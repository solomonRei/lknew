<?php

namespace App\Http\Controllers;

use App\Exports\OrderExport;
use App\Http\Requests\CreateOrderItemRequest;
use App\Http\Requests\OrderEditRequest;
use App\Http\Requests\OrderItemGetRequest;
use App\Http\Requests\UpdateOrderItemRequest;
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
            ->where('user_id', $this->userService->getCurrentUser()->id)
            ->whereNotIn('status', ['cancelled', 'deleted'])
            ->orderByRaw("CASE WHEN status = 'not_created' THEN 0 ELSE 1 END, updated_at DESC")
            ->get();

        return view('front.orders.index', compact('orders'));
    }

    public function create()
    {
        return view('front.orders.create');
    }

    public function edit(OrderEditRequest $request)
    {
        $orderId = $request->route('orderId');
        $order = Order::with(['items.photos', 'user.profile.phones' => function ($query) {
            $query->where('is_active', true)->latest()->limit(1);
        }, 'address'])->findOrFail($orderId);

        return view('front.orders.edit', compact('order'));
    }

    public function show(Order $order)
    {
        $order->load(['items.photos', 'user.profile.phones' => function ($query) {
            $query->where('is_active', true)->latest()->limit(1);
        }, 'address']);

        return view('front.orders.show', compact('order'));
    }

    public function getItem(OrderItemGetRequest $request)
    {
        $itemId = $request->route('itemId');
        $orderItem = OrderItem::with('photos')->find($itemId);
        if (!$orderItem) {
            return response()->json(['error' => 'Item not found'], 404);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'orderItem' => $orderItem,
            ],
        ]);
    }


    public function export(Order $order)
    {
        return Excel::download(new OrderExport($order), 'order-' . $order->id . '.xlsx');
    }

    public function storeItem(CreateOrderItemRequest $request)
    {
        $validated = $request->validated();

        $userId = auth()->id();

        $draftCount = Order::where('user_id', $userId)
            ->where('status', 'not_created')
            ->count();

        if ($draftCount >= 10) {
            return response()->json([
                'success' => false,
                'message' => 'Достигнуто максимальное количество черновиков (10).',
            ]);
        }

        $orderId = $request->input('order_id');
        $order = Order::find($orderId) ?? new Order([
                'user_id' => $userId,
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

    public function deleteItem($itemId)
    {
        $item = OrderItem::find($itemId);
        if (!$item) {
            return response()->json(['success' => false, 'message' => 'Позиция не найдена.']);
        }

        $item->delete();
        return response()->json(['success' => true, 'message' => 'Позиция успешно удалена.']);
    }

    public function updateItem(UpdateOrderItemRequest $request, $itemId)
    {
        $validated = $request->validated();

        $orderItem = OrderItem::find($itemId);
        if (!$orderItem) {
            return response()->json([
                'success' => false,
                'message' => 'Позиция не найдена.',
            ], 404);
        }

        $order = $orderItem->order;
        if ($order->user_id !== auth()->id()) {
            return response()->json([
                'success' => false,
                'message' => 'Нет доступа к этой позиции.',
            ], 403);
        }

        $orderItem->fill([
            'link' => $validated['link'],
            'name' => $validated['name'],
            'price' => $validated['price'],
            'quantity' => $validated['quantity'],
            'is_photo_report' => $request->input('edit_is_photo_report') == '1',
            'is_measure' => $request->input('edit_is_measure') == '1',
            'is_lathing' => $request->input('edit_is_lathing') == '1',
            'is_bubble_wrap' => $request->input('edit_is_bubble_wrap') == '1',
            'is_comment' => $request->input('edit_is_comment') == '1',
        ]);
        $orderItem->total_price = $orderItem->price * $orderItem->quantity;
        $orderItem->save();

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('order_items', $filename, 'public');

            $photo = $orderItem->photos()->firstOrCreate([], ['file_path' => $path]);
            $photo->file_path = $path;
            $photo->save();
        }

        return response()->json([
            'success' => true,
            'message' => 'Позиция успешно обновлена.',
            'data' => [
                'orderItem' => $orderItem->fresh(),
                ]
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
                'message' => 'Сумма заказа должна быть больше 10 000 рублей.',
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

    public function search(Request $request)
    {
        $searchTerm = $request->input('searchTerm');

        $orders = Order::with('items')
            ->where('user_id', auth()->id())
            ->where(function($query) use ($searchTerm) {
                $query->where('id', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('status', 'LIKE', "%{$searchTerm}%")
                    ->orWhereHas('items', function($q) use ($searchTerm) {
                        $q->where('name', 'LIKE', "%{$searchTerm}%");
                    });
            })
            ->get();


        $collectionOrders = $orders->map(function ($order) {
            return [
                'id' => $order->id,
                'created_at' => $order->created_at->format('d.m.Y'),
                'updated_at' => $order->updated_at->format('d.m.Y'),
                'items_count' => $order->items->count(),
                'total_amount' => $order->total_amount . ' ¥',
                'user_balance' => $order->user->balance . ' ¥',
                'status' => $order->status,
                'status_text' => __('orders.status.' . $order->status)
            ];
        });

        return view('front.orders.search', [
            'orders' => $collectionOrders,
            'searchTerm' => $searchTerm,
        ]);
    }

    public function cancelOrder(Request $request, $orderId)
    {
        $order = Order::find($orderId);
        if (!$order) {
            return response()->json(['success' => false, 'message' => 'Заказ не найден.']);
        }

        if ($order->user_id != auth()->id()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized']);
        }

        $order->status = 'cancelled';
        $order->save();

        return response()->json(['success' => true, 'message' => 'Заказ отменен.']);
    }

    public function deleteOrder(Request $request, $orderId)
    {
        $order = Order::find($orderId);
        if (!$order) {
            return response()->json(['success' => false, 'message' => 'Заказ не найден.']);
        }

        if ($order->user_id != auth()->id()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized']);
        }

        $order->status = 'deleted';
        $order->save();

        return response()->json(['success' => true, 'message' => 'Заказ удален.']);
    }


}
