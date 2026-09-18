<?php

namespace App\Providers;

use Illuminate\Auth\Middleware\RedirectIfAuthenticated;
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
        // Already-logged-in admins hitting /login or /register get sent
        // straight to the dashboard, instead of the framework's default
        // fallback (which would otherwise land them on the public homepage).
        RedirectIfAuthenticated::redirectUsing(fn () => route('admin.dashboard'));
    }
}
