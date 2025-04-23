<?php

use Domain\Favourites\Models\Favourite;
use Domain\Filaments\Models\PrinterFilament;
use Domain\Users\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\Fluent\AssertableJson;
use Laravel\Sanctum\Sanctum;

uses(RefreshDatabase::class);

it('deletes a favourite', function () {
    $user = User::factory()->create();
    Sanctum::actingAs($user);

    $favouritedFilament = PrinterFilament::factory()->create();

    Favourite::factory()->for(
        $favouritedFilament, 'favouritable'
    )->for($user)->create();

    $this->assertCount(1, Favourite::all());

    $this->deleteJson(route('favourites.delete', ['type' => 'printer_filament', 'id' => $favouritedFilament->id]))
        ->assertNoContent();

    $this->assertCount(0, Favourite::all());
});

it('throws an exception if an attempt is made to unfavourite an item which has not been favourited', function () {
    $user = User::factory()->create();
    Sanctum::actingAs($user);

    $filament = PrinterFilament::factory()->create();

    $this->deleteJson(route('favourites.delete', ['type' => 'printer_filament', 'id' => $filament->id]))
        ->assertUnprocessable()
        ->assertJson(fn (AssertableJson $json) => $json
            ->where('message', 'Item has not been added to favourites'));
});
