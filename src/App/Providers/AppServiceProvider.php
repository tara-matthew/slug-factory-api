<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        if (! $this->app->environment('production')) {
            $this->app->register('App\Providers\FakerServiceProvider');
        }
    }

    public function boot(): void
    {
        Factory::guessFactoryNamesUsing(function (string $modelName) {
            return '\Database\Factories\\' . class_basename($modelName) . 'Factory';
        });

        Password::defaults(function () {
            return Password::min(8)
                ->letters()
                ->mixedCase()
                ->numbers()
                ->symbols();
        });
    }
}
