<?php

use App\Favourites\Controllers\DeleteFavouriteController;
use App\Favourites\Controllers\IndexMyFavouritesController;
use App\Favourites\Controllers\StoreFavouriteController;
use App\Filaments\Brands\Controllers\IndexFilamentBrandsController;
use App\Filaments\Brands\Controllers\ShowFilamentBrandController;
use App\Filaments\Brands\Controllers\StoreFilamentBrandController;
use App\Filaments\Colours\Controllers\IndexFilamentColoursController;
use App\Images\Controllers\TestImageUploadController;
use App\PrintedDesigns\Controllers\IndexMyPrintedDesignsController;
use App\PrintedDesigns\Controllers\LatestPrintedDesignsController;
use App\PrintedDesigns\Controllers\ShowPrintedDesignController;
use App\PrintedDesigns\Controllers\StorePrintedDesignController;
use App\PrintedDesigns\Resources\PrintedDesignResource;
use App\Users\Controllers\LoginController;
use App\Users\Controllers\RegisterController;
use App\Users\Controllers\ShowUserProfileController;
use App\Users\Controllers\UpdateUserProfileController;
use Domain\PrintedDesigns\Models\PrintedDesign;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/prints/latest', LatestPrintedDesignsController::class)->name('prints.latest.index');
    Route::get('/prints/random', function () {
        return PrintedDesignResource::collection(
            PrintedDesign::query()
                ->with('filamentBrand',
                    'filamentColour',
                    'filamentMaterial')
                ->inRandomOrder()
                ->take(5)
                ->get()
        );
    });

    Route::get('/my/prints', IndexMyPrintedDesignsController::class)->name('my.prints.index'); // may also need prints index
    Route::get('/prints/{printedDesign}', ShowPrintedDesignController::class)->name('prints.show');
    Route::post('/prints', StorePrintedDesignController::class)->name('prints.store');

    Route::get('/my/favourites', IndexMyFavouritesController::class)->name('my.favourites.index');
    Route::post('/favourites/{type}/{id}', StoreFavouriteController::class)->name('favourites.store');
    Route::delete('/favourites/{type}/{id}', DeleteFavouriteController::class)->name('favourites.delete');

    Route::get('/me', ShowUserProfileController::class)->name('profile.show');
    Route::patch('/me', UpdateUserProfileController::class)->name('profile.update');
});

Route::get('/filament-brands', IndexFilamentBrandsController::class)->name('filament-brands.index');
Route::get('/filament-brands/{filamentBrand}', ShowFilamentBrandController::class)->name('filament-brands.show');
Route::post('/filament-brands', StoreFilamentBrandController::class)->name('filament-brands.store');

Route::get('/filament-colours', IndexFilamentColoursController::class)->name('filament-colours.index');

// TODO be cruddy by design and create a separate controller for Popular Prints

Route::post('/auth/login', LoginController::class)->name('login');
Route::post('/auth/register', RegisterController::class)->name('register');

Route::post('/upload', TestImageUploadController::class)->name('image');
