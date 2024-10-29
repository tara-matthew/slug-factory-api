<?php

use Domain\Favourites\Models\Favourite;
use Domain\PrintedDesigns\Models\PrintedDesign;
use Domain\Users\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\Fluent\AssertableJson;
use Laravel\Sanctum\Sanctum;

uses(RefreshDatabase::class);

it('deletes a favourite', function () {
    $user = User::factory()->create();

    $favouritedPrint = PrintedDesign::factory()
        ->for($user)
        ->create();

    Favourite::factory()->for(
        $favouritedPrint, 'favouritable'
    )->for($user)->create();

    $this->assertCount(1, Favourite::all());

    Sanctum::actingAs($user);
    $this->deleteJson(route('favourites.delete', ['type' => 'printed_design', 'id' => $favouritedPrint->id]))
        ->assertNoContent();

    $this->assertCount(0, Favourite::all());
});

it('throws an exception if an attempt is made to unfavourite an item which has not been favourited', function () {
    $user = User::factory()->create();

    $print = PrintedDesign::factory()
        ->for($user)
        ->create();

    Sanctum::actingAs($user);

    $this->deleteJson(route('favourites.delete', ['type' => 'printed_design', 'id' => $print->id]))
        ->assertUnprocessable()
        ->assertJson(fn (AssertableJson $json) => $json
            ->where('message', 'Item has not been added to favourites'));
});
