<?php

namespace App\Providers;

use App\Interfaces\Services\UserProfileServiceInterface;
use App\Interfaces\Services\UserServiceInterface;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(UserProfileServiceInterface $userProfileService, UserServiceInterface $userService)
    {
        View::composer('*', function ($view) use ($userProfileService, $userService) {
            if (auth()->check()) {
                $userProfile = $userProfileService->getAuthenticatedUserProfile();
                $user = $userService->getCurrentUser();

                $view->with('userProfile', $userProfile);
                $view->with('user', $user);
            }
        });
    }
}
