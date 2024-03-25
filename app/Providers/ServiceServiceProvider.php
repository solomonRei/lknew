<?php

namespace App\Providers;

use App\Interfaces\Services\UserProfileServiceInterface;
use App\Services\UserProfileService;
use Illuminate\Support\ServiceProvider;
use App\Interfaces\Services\UserServiceInterface;
use App\Services\UserService;

class ServiceServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register() : void
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot() : void
    {
        $this->app->bind(
            UserServiceInterface::class,
            UserService::class);
        $this->app->bind(
            UserProfileServiceInterface::class,
            UserProfileService::class);
    }
}
