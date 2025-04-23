<?php

use Domain\Favourites\Models\Favourite;
use Domain\Filaments\Models\PrinterFilament;
use Domain\Users\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Illuminate\Testing\Fluent\AssertableJson;
use Laravel\Sanctum\Sanctum;

uses(RefreshDatabase::class);

it('stores a favourite', function () {
    Event::fake();

    $filament = PrinterFilament::factory()->create();
    Sanctum::actingAs(User::factory()->create());

    $this->postJson(route('favourites.store', ['type' => 'printer_filament', 'id' => $filament->id]))
        ->assertCreated();

    $this->assertCount(1, Favourite::all());
    $this->assertDatabaseHas('favourites', [
        'user_id' => Auth::id(),
        'favouritable_type' => 'printer_filament',
        'favouritable_id' => $filament->id]);
});

it('throws an exception if an item has already been favourited by the authenticated user', function () {
    $authenticatedUser = User::factory()->create();
    Sanctum::actingAs($authenticatedUser);

    $favouritedFilament = PrinterFilament::factory()->create();

    Favourite::factory()->for(
        $favouritedFilament, 'favouritable'
    )->for($authenticatedUser)->create();

    $this->assertCount(1, Favourite::all());

    $this
        ->postJson(route('favourites.store', ['type' => 'printer_filament', 'id' => $favouritedFilament->id]))
        ->assertUnprocessable()
        ->assertJson(fn (AssertableJson $json) => $json
            ->where('message', 'Item has already been added to favourites'));

    $this->assertCount(1, Favourite::all());

});
