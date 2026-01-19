<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //gates

        Gate::define('user_is_admin', function (User $user) {
            return $user->role === 'admin';
        });

        Gate::define('user_is_user', function (User $user) {
            return $user->role === 'user';
        });

        //o usuario pode fazer inserts?
        Gate::define('user_can_insert', function (User $user) {
            return in_array('insert', json_decode($user->permissions));
        });

        //o usuario pode fazer deletes?
        Gate::define('user_can_delete', function (User $user) {
            return in_array('delete', json_decode($user->permissions));
        });

        Gate::define('user_can', function (User $user, string $permission) {
            return in_array($permission, json_decode($user->permissions));
        });
    }
}
