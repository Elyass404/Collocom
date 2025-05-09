<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Situation;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use App\Repositories\Eloquent\AuthRepository;
use App\Repositories\Eloquent\RoleRepository;
use App\Repositories\Eloquent\UserRepository;
use App\Repositories\Eloquent\OfferRepository;
use App\Repositories\Eloquent\CategoryRepository;
use App\Repositories\Eloquent\SituationRepository;



use App\Repositories\Eloquent\OfferPhotoRepository;
use App\Repositories\Eloquent\PermissionRepository;
use App\Repositories\Eloquent\OfferRequestRepository;
use App\Repositories\Interfaces\AuthRepositoryInterface;
use App\Repositories\Interfaces\RoleRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\Interfaces\OfferRepositoryInterface;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\interfaces\SituationRepositoryInterface;
use App\Repositories\Interfaces\OfferPhotoRepositoryInterface;
use App\Repositories\Interfaces\PermissionRepositoryInterface;
use App\Repositories\Interfaces\OfferRequestRepositoryInterface;

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
        //binding the OfferRepositoryInterface with the OfferRepository
        $this->app->bind(OfferRepositoryInterface::class, OfferRepository::class);
        //binding the OfferPhotoRepositoryInterface with the OfferPhotoRepository
        $this->app->bind(OfferPhotoRepositoryInterface::class, OfferPhotoRepository::class);
        //binding the OfferRequestRepositoryInterface with the OfferRequestRepository
        $this->app->bind(OfferRequestRepositoryInterface::class, OfferRequestRepository::class);
        //binding the SituationRequestRepositoryInterface with the SituationRequestRepository
        $this->app->bind(SituationRepositoryInterface::class, SituationRepository::class);
        //binding the RoleRequestRepositoryInterface with the RoleRequestRepository
        $this->app->bind(RoleRepositoryInterface::class, RoleRepository::class);
        //binding the PermissionRequestRepositoryInterface with the PermissionRequestRepository
        $this->app->bind(PermissionRepositoryInterface::class, PermissionRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app['router']->aliasMiddleware('role', \App\Http\Middleware\CheckRole::class);
        $this->app['router']->aliasMiddleware('permission', \App\Http\Middleware\CheckPermission::class);
    }
}
