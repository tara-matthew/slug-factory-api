<?php

namespace App\Providers;

use Carbon\CarbonImmutable;
use Domain\Filaments\Brands\Models\FilamentBrand;
use Domain\Filaments\Models\PrinterFilament;
use Domain\PrintedDesigns\Events\PrintedDesignFavourited;
use Domain\PrintedDesigns\Events\PrintedDesignUploaded;
use Domain\PrintedDesigns\Listeners\SendPrintedDesignFavouritedMailNotification;
use Domain\PrintedDesigns\Listeners\SendPrintedDesignUploadedPushNotification;
use Domain\PrintedDesigns\Models\PrintedDesign;
use Domain\Printers\Models\Printer;
use Domain\Users\Events\UserCreated;
use Domain\Users\Listeners\CreateUserAvatar;
use Domain\Users\Listeners\CreateUserDefaultLists;
use Domain\Users\Listeners\CreateUserProfile;
use Domain\Users\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\URL;
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
        $this->configureCommands();
        $this->configureModels();
        $this->configureUrl();
        $this->configureDates();

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

        Event::listen(
            PrintedDesignUploaded::class,
            SendPrintedDesignUploadedPushNotification::class,
        );
        Event::listen(
            PrintedDesignFavourited::class,
            SendPrintedDesignFavouritedMailNotification::class,
        );
        Event::listen(
            UserCreated::class,
            CreateUserAvatar::class,
        );
        Event::listen(
            UserCreated::class,
            CreateUserProfile::class,
        );
        Event::listen(
            UserCreated::class,
            CreateUserDefaultLists::class,
        );
    }

    private function configureCommands(): void
    {
        DB::prohibitDestructiveCommands(
            $this->app->isProduction(),
        );
    }

    private function configureModels(): void
    {
        Model::shouldBeStrict();

        //        Model::unguard();
    }

    private function configureUrl(): void
    {
        URL::forceScheme('https');
    }

    private function configureDates(): void
    {
        Date::use(CarbonImmutable::class);
    }
}
