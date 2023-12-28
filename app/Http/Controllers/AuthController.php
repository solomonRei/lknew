<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    protected AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function showLoginForm()
    {
        return view('front.login');
    }

    public function register(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = $this->authService->register($request->all());

        Auth::login($user);

        return redirect()->intended('/');
    }

    public function login(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if ($this->authService->login($request->only('email', 'password'))) {
            return redirect()->intended('/profile');
        }

        return back()->withErrors([
            'email' => __('messages.auth_error'),
        ]);
    }

    public function logout(Request $request)
    {
        $this->authService->logout();

        return redirect('/login');
    }
}
