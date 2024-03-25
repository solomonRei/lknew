<?php


namespace App\Interfaces\Services;


use App\Models\User;

interface UserServiceInterface
{

    /**
     * @param array $data
     * @return User
     */
    public function registerUser(array $data): User;

    /**
     * @param array $credentials
     * @return mixed
     */
    public function login($credentials);


    /**
     * @return void
     */
    public function logout(): void;

    /**
     * @return \Illuminate\Contracts\Auth\Authenticatable
     */
    public function getCurrentUser(): \Illuminate\Contracts\Auth\Authenticatable;

    /**
     * @param User $user
     * @param string $currentPassword
     * @param string $newPassword
     * @return bool
     */
    public function changePassword(User $user, string $currentPassword, string $newPassword): bool;
}
