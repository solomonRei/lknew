<?php


namespace App\Interfaces\Services;


interface UserProfileServiceInterface
{
    public function getAuthenticatedUserProfile();

    public function updateAvatar($imageFile);
}
