<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Gate::define('delete-product', function (User $user) {
            return $user->isProductManager();
        });

        Gate::define('trash-list', function (User $user) {
            return $user->isAdmin();
        });
    }
}
