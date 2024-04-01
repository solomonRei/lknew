<?php


namespace App\Services;


use App\Interfaces\Repositories\UserProfileRepositoryInterface;
use App\Interfaces\Services\UserProfileServiceInterface;
use App\Interfaces\Services\UserServiceInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserProfileService implements UserProfileServiceInterface
{
    private UserProfileRepositoryInterface $userProfileRepository;
    private UserServiceInterface $userService;

    public function __construct(UserProfileRepositoryInterface $userProfileRepository, UserServiceInterface $userService)
    {
        $this->userProfileRepository = $userProfileRepository;
        $this->userService = $userService;
    }

    public function getAuthenticatedUserProfile()
    {
        $user = $this->userService->getCurrentUser();
        if (!$user) {
            throw new ModelNotFoundException('User with ID:  not found!');
        }

        $user->load(['profile']);

        if (!$user->profile) {
            throw new ModelNotFoundException('Profile for user with ID:  not found!');
        }

        $user->profile->load(['phones' => function ($query) {
            $query->orderBy('is_active', 'desc')->orderBy('created_at', 'desc')->get();
        }, 'addresses' => function ($query) {
            $query->orderBy('is_active', 'desc')->orderBy('created_at', 'desc')->get();
        }, 'socialLinks']);

        return $user->profile;
    }

    public function updateAvatar($imageFile)
    {
        $user = $this->userService->getCurrentUser();
        if (!$user || !$user->profile) {
            throw new ModelNotFoundException('User or profile not found!');
        }

        $imageBlob = file_get_contents($imageFile->getRealPath());

        $user->profile->update(['avatar' => $imageBlob]);

        return $user->profile;
    }

    public function updateProfile($userId, array $profileData)
    {
        $userProfile = $this->userProfileRepository->findByUserId($userId);

        if (!$userProfile) {
            throw new ModelNotFoundException("Profile not found for user ID: $userId");
        }

        // Update the basic profile information
        $userProfile->update($profileData['profile']);

        // Update addresses and phones as needed
        // Assuming $profileData contains 'addresses' and 'phones' arrays
        if (isset($profileData['addresses'])) {
            // Handle addresses update logic here
        }

        if (isset($profileData['phones'])) {
            // Handle phones update logic here
        }

        return $userProfile;
    }

}
