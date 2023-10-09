<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;
use Support\Contracts\ExternalService;
use Support\Services\ExternalServiceStub;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        if (! $this->app->environment('production')) {
            $this->app->register('App\Providers\FakerServiceProvider');
        }

        // Bind to the interface, this can be swapped out with a real implementation
        $this->app->singleton(ExternalService::class, ExternalServiceStub::class);

        /**
        If we need a token or anything for the external api, we could bind this here
        $this->app->singleton(ExternalService::class, function () {
            $client = new ExternalServiceStub(
                [
                    'grant_type' => config(''),
                    'client_id' => config('),
                    'client_secret' => config(''),
                    'username' => config(''),
                    'password' => config(''),
                ]
            );
         **/
    }

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
    }
}
