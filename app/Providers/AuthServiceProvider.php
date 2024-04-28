<?php

namespace App\Providers;

use App\Models\User;
use App\Policies\ProductPolicy;
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
        Gate::define('delete-product',[ProductPolicy::class,'delete']);

        Gate::define('trash-list', function (User $user) {
            return $user->isAdmin();
        });
    }
}
