<?php

use App\Favourites\Controllers\FavouritePrintedDesignController;
use App\Filaments\Brands\Controllers\FilamentBrandController;
use App\PrintedDesigns\Controllers\PrintedDesignController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['auth:sanctum'])->group(function () {
    Route::resource('prints', PrintedDesignController::class)->parameters(['prints' => 'printed_design']);
    Route::resource('filament-brands', FilamentBrandController::class);
    Route::resource('users.favourite-printed-designs', FavouritePrintedDesignController::class)->parameters(['favourite-printed-designs' => 'printed_design']);
});

// TODO be cruddy by design and create a separate controller for Popular Prints

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Route::resource('prints', PrintedDesignController::class)->parameters(['prints' => 'printed_design']);
//Route::post('/auth/register', RegisterController::class);
