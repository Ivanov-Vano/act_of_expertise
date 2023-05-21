<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Filament\Facades\Filament;
use Filament\Navigation\NavigationGroup;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Filament::serving(function () {
            Filament::registerNavigationGroups([
                NavigationGroup::make()
                    ->label('Справочники')
                    ->icon('heroicon-s-pencil'),
                NavigationGroup::make()
                    ->label('ТН ВЭД')
                    ->icon('heroicon-s-shopping-cart'),

                NavigationGroup::make()
                    ->label('Администрирование')
                    ->icon('heroicon-s-cog')
                    ->collapsed(),
            ]);
        });
    }
}
