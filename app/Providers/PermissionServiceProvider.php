<?php

namespace App\Providers;
use App;
use App\Permission;
use Illuminate\Http\Request;
use App\Role;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Auth;
use App\Services\UserPermission;

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
            return App::make(UserPermission::class);
        });

    
    }
}
