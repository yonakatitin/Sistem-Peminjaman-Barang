<?php

namespace App\Providers;
use Illuminate\Support\Facades\View;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;

class NavigationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $user = Auth::user();
        $userName = $user ? $user->name : null;
        View::share('userName', $userName);
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
