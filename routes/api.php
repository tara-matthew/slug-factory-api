<?php

use App\Favourites\Controllers\FavouritePrintedDesignController;
use App\Filaments\Brands\Controllers\FilamentBrandController;
use App\Filaments\Colours\Controllers\FilamentColourController;
use App\PrintedDesigns\Controllers\IndexPrintedDesignsController;
use App\PrintedDesigns\Controllers\PrintedDesignController;
use App\PrintedDesigns\Controllers\ShowPrintedDesignController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// TODO add named routes
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/prints', IndexPrintedDesignsController::class)->name('prints.index');
    Route::get('/prints/{printedDesign}', ShowPrintedDesignController::class)->name('prints.show');
    Route::resource('prints', PrintedDesignController::class)->parameters(['prints' => 'printed_design'])->except(['index', 'show']);
    Route::resource('filament-brands', FilamentBrandController::class);
    Route::resource('users.favourite-printed-designs', FavouritePrintedDesignController::class)->parameters(['favourite-printed-designs' => 'printed_design']);
});

Route::resource('filament-colours', FilamentColourController::class);


// TODO be cruddy by design and create a separate controller for Popular Prints

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Route::resource('prints', PrintedDesignController::class)->parameters(['prints' => 'printed_design']);
//Route::post('/auth/register', RegisterController::class);
