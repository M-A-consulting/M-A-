<?php

namespace App\Providers;

use Filament\Facades\Filament;
use Illuminate\Support\ServiceProvider;

class FilamentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Filament::registerBrandName('My Custom Title');
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
