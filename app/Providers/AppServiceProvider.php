<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use App\Repositories\Eloquent\AuthRepository;
use App\Repositories\Eloquent\UserRepository;


use App\Repositories\Eloquent\CategoryRepository;
use App\Repositories\Interfaces\AuthRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\Interfaces\CategoryRepositoryInterface;


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
        //binding the CategoryRepositoryInterface with the CategoryRepository
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
    //
    }
}
