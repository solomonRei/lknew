<?php


namespace App\Repository;


use App\Interfaces\Repositories\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserRepository implements UserRepositoryInterface
{

    public function createUser(array $data): User
    {
        return User::create($data);
    }

    public function updateUser(User $user, array $data) : bool
    {
        return $user->update($data);
    }

    public function deleteUser(int $id)
    {
        // TODO: Implement deleteUser() method.
    }

    public function getUserById(int $id)
    {
        return User::find($id);
    }

    public function getAllUsers(): Collection
    {
        return User::all();
    }
}
