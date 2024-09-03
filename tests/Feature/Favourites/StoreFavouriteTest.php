<?php

use Domain\Favourites\Models\Favourite;
use Domain\PrintedDesigns\Models\PrintedDesign;
use Domain\Users\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Testing\Fluent\AssertableJson;

uses(RefreshDatabase::class);

it('stores a favourite', function () {
    $print = PrintedDesign::factory()->create();
    asLoggedInUser()
        ->postJson(route('favourites.store', ['type' => 'printed_design', 'id' => $print->id]))
        ->assertCreated();

    $this->assertCount(1, Favourite::all());
    $this->assertDatabaseHas('favourites', [
        'user_id' => Auth::id(),
        'favouritable_type' => 'printed_design',
        'favouritable_id' => $print->id]);
});

it('throws an exception if an item has already been favourited by the authenticated user, differentiating between different items belonging to the same user', function () {
    $authenticatedUser = User::factory()->create();

    $favouritedPrint = PrintedDesign::factory()
        ->for($authenticatedUser)
        ->create();

    $secondPrint = PrintedDesign::factory()
        ->for($authenticatedUser)
        ->create();

    // Make a favourite for the first print and the current user
    Favourite::factory()->for(
        $favouritedPrint, 'favouritable'
    )->for($authenticatedUser)->create();

    $this->assertCount(1, Favourite::all());

    asLoggedInUser()
        ->postJson(route('favourites.store', ['type' => 'printed_design', 'id' => $favouritedPrint->id]))
        ->assertUnprocessable()
        ->assertJson(fn (AssertableJson $json) => $json
            ->where('message', 'Item has already been added to favourites'));

    $this->assertCount(1, Favourite::all());

});
