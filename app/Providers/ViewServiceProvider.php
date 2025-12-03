<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\View\Composers\MenuComposer;
use App\View\Composers\ChristmasComposer;

class ViewServiceProvider extends ServiceProvider
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
        // Attach the menu composer to all views that use the app layout
        View::composer(['layouts.app', 'home', 'products.*', 'categories.*', 'checkout.*', 'cart.*', 'auth.*', 'user.*'], MenuComposer::class);
        
        // Attach the Christmas composer to all views
        View::composer('*', ChristmasComposer::class);
    }
}