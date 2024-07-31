<?php

use App\Favourites\Controllers\FavouritePrintedDesignController;
use App\Favourites\Controllers\IndexMyFavouritePrintedDesignsController;
use App\Filaments\Brands\Controllers\FilamentBrandController;
use App\Filaments\Colours\Controllers\FilamentColourController;
use App\PrintedDesigns\Controllers\IndexMyPrintedDesignsController;
use App\PrintedDesigns\Controllers\LatestPrintedDesignsController;
use App\PrintedDesigns\Controllers\ShowPrintedDesignController;
use App\PrintedDesigns\Controllers\StorePrintedDesignController;
use App\PrintedDesigns\Resources\PrintedDesignResource;
use Domain\PrintedDesigns\Models\PrintedDesign;
use Illuminate\Support\Facades\Route;

//Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/prints/latest', LatestPrintedDesignsController::class)->name('prints.latest.index');
    Route::get('/prints/random', function () {
        return PrintedDesignResource::collection(
            PrintedDesign::query()
                ->inRandomOrder()
                ->take(10)
                ->get()
        );
    });

    Route::get('/prints', IndexMyPrintedDesignsController::class)->name('my.prints.index');
    Route::get('/prints/{printedDesign}', ShowPrintedDesignController::class)->name('prints.show');
    Route::post('/prints', StorePrintedDesignController::class)->name('prints.store');

    Route::resource('filament-brands', FilamentBrandController::class);
//    Route::resource('users.favourite-printed-designs', FavouritePrintedDesignController::class)->parameters(['favourite-printed-designs' => 'printed_design']); // todo change to my

    Route::get('/favourites/printed-designs', IndexMyFavouritePrintedDesignsController::class)->name('my.favourites.printed-designs.index'); // todo this may replace the favourite printed design controller

//    Route::post('/favourites');
//});



Route::resource('filament-colours', FilamentColourController::class);

// TODO be cruddy by design and create a separate controller for Popular Prints

//Route::post('/auth/register', RegisterController::class);
