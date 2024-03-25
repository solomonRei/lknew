<?php


namespace App\Services;


use App\Interfaces\Repositories\UserRepositoryInterface;
use App\Interfaces\Services\UserServiceInterface;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserService implements UserServiceInterface
{

    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param array $data
     * @return User
     */
    public function registerUser(array $data): User
    {
        return $this->userRepository->createUser([
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    /**
     * @param array $credentials
     * @return bool|\Illuminate\Contracts\Auth\Authenticatable
     */
    public function login($credentials): bool|\Illuminate\Contracts\Auth\Authenticatable
    {
        if (!Auth::attempt($credentials)) {
            return false;
        }

        return Auth::user();
    }

    /**
     * @return void
     */
    public function logout(): void
    {
        Auth::logout();
    }

    /**
     * @return \Illuminate\Contracts\Auth\Authenticatable
     */
    public function getCurrentUser(): \Illuminate\Contracts\Auth\Authenticatable
    {
        return Auth::user();
    }

    public function getCurrentUserById(int $id): User
    {
        return $this->userRepository->getUserById($id);
    }

    /**
     * @param User $user
     * @param string $currentPassword
     * @param string $newPassword
     * @return bool
     */
    public function changePassword(User $user, string $currentPassword, string $newPassword): bool
    {
        if (!Hash::check($currentPassword, $user->password)) {
            return false;
        }

        return $this->userRepository->updateUser($user, ['password' => Hash::make($newPassword)]);
    }
}
