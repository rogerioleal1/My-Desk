<?php

namespace App\Providers;

use App\Permission;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        if (App::runningInConsole()) {
            echo 'Running in console (i.e. migration).  Disabling AuthServiceProvider' . PHP_EOL;
            return;
        }

        $this->registerPolicies();

        Gate::before(function($user, $ability) {
            if ($user->isAdmin()) return true;
        });

        $permissions = Permission::with('groups')->get();
        foreach ($permissions as $permission) {
            Gate::define($permission->route, function ($user) use ($permission) {
                return $user->hasPermission($permission);
            });
        }
    }
}
