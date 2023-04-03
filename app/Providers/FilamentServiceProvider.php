<?php

namespace App\Providers;

use Filament\Facades\Filament;
use Illuminate\Foundation\Vite;
use Illuminate\Support\ServiceProvider;

class FilamentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Filament::serving(function () {
            // Using Vite
//            Filament::registerViteTheme('resources/css/filament.css');
            Filament::registerTheme(
                app(Vite::class)('resources/css/filament.css'),
            );

        });
    }
}
