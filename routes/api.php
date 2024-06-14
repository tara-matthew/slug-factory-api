<?php

use App\Favourites\Controllers\FavouritePrintedDesignController;
use App\Filaments\Brands\Controllers\FilamentBrandController;
use App\Filaments\Colours\Controllers\FilamentColourController;
use App\PrintedDesigns\Controllers\IndexPrintedDesignsController;
use App\PrintedDesigns\Controllers\PrintedDesignController;
use App\PrintedDesigns\Controllers\ShowPrintedDesignController;
use App\PrintedDesigns\Controllers\StorePrintedDesignController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/prints', IndexPrintedDesignsController::class)->name('prints.index');
    Route::get('/prints/{printedDesign}', ShowPrintedDesignController::class)->name('prints.show');
    Route::post('/prints', StorePrintedDesignController::class)->name('prints.store');

    Route::resource('filament-brands', FilamentBrandController::class);
    Route::resource('users.favourite-printed-designs', FavouritePrintedDesignController::class)->parameters(['favourite-printed-designs' => 'printed_design']);
});

Route::resource('filament-colours', FilamentColourController::class);

// TODO be cruddy by design and create a separate controller for Popular Prints

//Route::post('/auth/register', RegisterController::class);
