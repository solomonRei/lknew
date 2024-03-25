<?php


namespace App\Interfaces\Repositories;


use App\Models\User;

interface UserRepositoryInterface
{
    public function createUser(array $data);
    public function updateUser(User $user, array $data) : bool;
    public function deleteUser(int $id);
    public function getUserById(int $id);
    public function getAllUsers();
}
