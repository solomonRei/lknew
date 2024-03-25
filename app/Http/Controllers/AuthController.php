<?php

namespace App\Http\Controllers;

use App\Interfaces\Services\UserServiceInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthController extends Controller
{
    private UserServiceInterface $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm(): View
    {
        return view('front.login');
    }

    /**
     * Show the application registration form.
     *
     * @param \Illuminate\Http\Request $request
     * @return RedirectResponse
     */
    public function register(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = $this->userService->registerUser($request->all());

        Auth::login($user);

        return redirect()->intended('/');
    }

    /**
     * Show the application login form.
     *
     * @param \Illuminate\Http\Request $request
     * @return RedirectResponse
     */
    public function login(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if ($this->userService->login($request->only('email', 'password'))) {
            return redirect()->intended('/profile');
        }

        return back()->withErrors([
            'email' => __('messages.auth_error'),
        ]);
    }

    public function logout(Request $request)
    {
        $this->userService->logout();

        return redirect('/login');
    }
}
