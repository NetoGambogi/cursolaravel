<?php

namespace App\Providers;

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
        // gates

        // gate que verifica se o usuario é admin
        Gate::define('admin', function(){
            return auth()->user()->role === 'admin';
        });

        // gate que verifica se o usuario é rh
        Gate::define('rh', function(){
            return auth()->user()->role === 'rh';
        });

        // gate que verifica se o usuario é colaborador normal
        Gate::define('colaborator', function(){
            return auth()->user()->role === 'colaborator';
        });
    }
}
