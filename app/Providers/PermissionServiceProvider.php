<?php

namespace App\Providers;
use App;
use App\Services\UserPermissionService;

use Illuminate\Support\ServiceProvider;


class PermissionServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
    
        $this->app->singleton('userPermissions', function () {
            return App::make(UserPermissionService::class);
        });

    }
}
