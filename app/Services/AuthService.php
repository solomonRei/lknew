<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    public function register($data)
    {
        $user = User::create([
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        return $user;
    }

    public function login($credentials)
    {
        if (!Auth::attempt($credentials)) {
            return false;
        }

        return Auth::user();
    }

    public function logout()
    {
        Auth::logout();
    }
}
