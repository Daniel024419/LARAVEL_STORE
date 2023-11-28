<?php

namespace App\Providers\API\V1;

use App\Repository\Users\UserInterfaceRepository;
use App\Repository\Users\UserRepository;
use App\Services\Users\UserService;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Bind the UserInterfaceRepository interface to the UserRepository class.
        $this->app->bind(UserInterfaceRepository::class, UserRepository::class);

        // Bind the UserService to the container
        $this->app->bind(UserService::class, function ($app) {
            return new UserService($app->make(UserInterfaceRepository::class));
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // ...
    }
}
 