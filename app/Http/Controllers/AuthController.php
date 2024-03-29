<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
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
     * @param \App\Http\Requests\RegisterRequest $request
     * @return RedirectResponse
     */
    public function register(RegisterRequest $request): RedirectResponse
    {
        $user = $this->userService->registerUser($request->validated());

        Auth::login($user);

        return redirect()->intended('/');
    }

    /**
     * Show the application login form.
     *
     * @param \App\Http\Requests\LoginRequest $request
     * @return RedirectResponse
     */
    public function login(LoginRequest $request): RedirectResponse
    {
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
