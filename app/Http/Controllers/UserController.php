<?php

namespace App\Http\Controllers;

use App\Http\Requests\PasswordChangeRequest;
use App\Interfaces\Services\UserServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    private UserServiceInterface $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    public function changePassword(PasswordChangeRequest $request)
    {

        $currentPassword = $request->input('password');
        $newPassword = $request->input('new-password');


        if ($this->userService->changePassword($this->userService->getCurrentUserById(Auth::id()), $currentPassword, $newPassword)) {
            return redirect()->back()->with('success', 'Пароль успешно изменен.');
        }

        return redirect()->back()->withErrors(['password' => 'Неверный текущий пароль.']);
    }
}
