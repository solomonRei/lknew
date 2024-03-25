<?php

namespace App\Providers;

use App\Interfaces\Repositories\UserProfileRepositoryInterface;
use App\Interfaces\Repositories\UserRepositoryInterface;
use App\Repository\UserProfileRepository;
use App\Repository\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->app->bind(
            UserRepositoryInterface::class,
            UserRepository::class);
        $this->app->bind(
            UserProfileRepositoryInterface::class,
            UserProfileRepository::class);
    }
}
