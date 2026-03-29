<?php

namespace App\Providers;

use Illuminate\Support\Facades\File;
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
        // Shared hosting / FTP deploys sometimes omit empty dirs — Blade needs these.
        foreach ([
            storage_path('framework/views'),
            storage_path('framework/cache'),
            storage_path('framework/cache/data'),
            storage_path('framework/sessions'),
            storage_path('logs'),
        ] as $path) {
            if (! is_dir($path)) {
                File::makeDirectory($path, 0755, true);
            }
        }
    }
}
