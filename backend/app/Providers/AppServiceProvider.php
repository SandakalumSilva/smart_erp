<?php

namespace App\Providers;

use App\Interfaces\PermissionInterface;
use Illuminate\Support\ServiceProvider;
use App\Interfaces\RoleRepositoryInterface;
use App\Repositories\PermissionRepository;
use App\Repositories\RoleRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(RoleRepositoryInterface::class, RoleRepository::class);
        $this->app->bind(PermissionInterface::class, PermissionRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
