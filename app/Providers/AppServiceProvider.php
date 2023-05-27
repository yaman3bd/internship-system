<?php

namespace App\Providers;
use Filament\Facades\Filament;
use Filament\Navigation\NavigationGroup;
use Illuminate\Routing\Route;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        Route::macro('isWith', function (...$parameters) {
            foreach ($parameters as $parameter) {
                if (url()->current() == !is_array($parameter) ? route($parameter) : route($parameter[0], $parameter[1] ?? [])) {
                    return true;
                }
            }
            return false;
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

    }
}
