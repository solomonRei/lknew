<?php

namespace App\Http\Controllers;

use App\Services\UserProfileService2;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserProfileController2 extends Controller
{
    protected UserProfileService2 $userProfileService;

    public function __construct(UserProfileService2 $userProfileService)
    {
        $this->userProfileService = $userProfileService;
        $this->middleware('auth');
    }

    public function index()
    {
        $userId = Auth::id();
        $profile = $this->userProfileService->getUserProfile($userId);
        return view('front.index', ['profile' => $profile]);
    }

    public function update(Request $request)
    {
        $userId = Auth::id();
        $rules = [
            'name' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:255',
            'telegram_chat_id' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'passport_data' => 'nullable|string|max:255',
        ];

        if ($request->has('new_password') && $request->get('new_password') !== null) {
            $rules['new_password'] = 'required|string|min:8';
        }

        $validatedData = $request->validate($rules);

        if (isset($validatedData['new_password']) && !empty($validatedData['new_password'])) {
            $user = Auth::user();
            $user->password = Hash::make($validatedData['new_password']);
            $user->save();
        }

        $this->userProfileService->updateUserProfile($userId, $validatedData);
        return redirect()->back()->with('success', __('messages.profile_updated'));
    }
}
