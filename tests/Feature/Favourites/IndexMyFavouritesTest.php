<?php

use App\Favourites\Controllers\IndexMyFavouritesController;
use Carbon\Carbon;
use Domain\Favourites\Models\Favourite;
use Domain\Filaments\Models\PrinterFilament;
use Domain\Users\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\Fluent\AssertableJson;

uses(RefreshDatabase::class);
covers(IndexMyFavouritesController::class);

it('returns a list of the favourites of the authenticated user', function () {
    Carbon::setTestNow(Carbon::parse('2025-06-16 12:00:00'));
    $user = User::factory()->createQuietly();
    $favouritedFilament = PrinterFilament::factory()->create();

    $favourite = Favourite::factory()->for(
        $favouritedFilament, 'favouritable'
    )->for($user)->create();

    $this
        ->actingAs($user)->getJson(route('my.favourites.index', ['type' => 'printer_filament']))
        ->assertOk()
        ->assertJson(fn (AssertableJson $json) => $json->has('data', 1)
            ->has('data.0', fn (AssertableJson $json) => $json->where('id', $favourite->first()->id)
                ->where('favourited_at', Carbon::now()->toISOString())
                ->has('resource', fn (AssertableJson $json) => $json->where('id', $favouritedFilament->id)
                    ->where('image_url', $favouritedFilament->image_url)
                    ->etc())
                ->etc()
            )
            ->etc()
        );
});
