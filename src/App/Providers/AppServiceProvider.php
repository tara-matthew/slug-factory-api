<?php

namespace App\Providers;

use Domain\Filaments\Brands\Models\FilamentBrand;
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
        //
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
            'user' => User::class,
        ]);
    }
}
