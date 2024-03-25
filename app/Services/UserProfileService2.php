<?php

namespace App\Services;

use App\Models\User;
use App\Models\UserProfile;

class UserProfileService2
{
    public function getUserProfile($userId)
    {
        return UserProfile::where('user_id', $userId)->first();
    }

    public function createUserProfile($userId, $data)
    {
        $profileData = array_merge($data, ['user_id' => $userId]);
        return UserProfile::create($profileData);
    }

    public function updateUserProfile($userId, $data)
    {
        $profile = UserProfile::where('user_id', $userId)->first();
        if ($profile) {
            $profile->update($data);
            return $profile;
        }

        return $this->createUserProfile($userId, $data);
    }
}
