<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Interfaces\AuthRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;

use App\Repositories\Eloquent\AuthRepository;
use App\Repositories\Eloquent\UserRepository;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //binding the AuthRepositoryinterface with the AuthRepository
        $this->app->bind(AuthRepositoryInterface::class,AuthRepository::class);
        //binding the UserRepositoryInterface with the UserRepository
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
