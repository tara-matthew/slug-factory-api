<?php

namespace App\Providers;

use Domain\Filaments\Brands\Models\FilamentBrand;
use Domain\Filaments\Models\PrinterFilament;
use Domain\PrintedDesigns\Models\PrintedDesign;
use Domain\Printers\Models\Printer;
use Domain\Users\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        if ($this->app->environment('local')) {
            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
            $this->app->register(TelescopeServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Factory::guessFactoryNamesUsing(function (string $modelName) {
            return '\Database\Factories\\'.class_basename($modelName).'Factory';
        });

        Password::defaults(function () {
            return Password::min(8)
                ->letters()
                ->mixedCase()
                ->numbers()
                ->symbols();
        });

        Relation::enforceMorphMap([
            'printed_design' => PrintedDesign::class,
            'filament_brand' => FilamentBrand::class,
            'printer' => Printer::class,
            'printer_filament' => PrinterFilament::class,
            'user' => User::class,
        ]);
    }
}
