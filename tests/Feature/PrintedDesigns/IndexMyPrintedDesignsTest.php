<?php

namespace Tests\Feature\PrintedDesigns;

use Domain\Favourites\Models\Favourite;
use Domain\PrintedDesigns\Models\PrintedDesign;
use Domain\Users\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\Fluent\AssertableJson;

uses(RefreshDatabase::class);

it('returns a list of prints', function () {
    $user = User::factory()->create();
    $prints = PrintedDesign::factory(2)
        ->hasMasterImages()
        ->for($user)
        ->create();

    // Make a favourite for the first print and the current user
    Favourite::factory()->for(
        $prints->first(), 'favouritable'
    )->for($user)->create();

    asLoggedInUser()
        ->getJson(route('my.prints.index'))
        ->assertOk()
        ->assertJson(fn (AssertableJson $json) => $json
            ->where('data.0.id', $prints[0]->id)
            ->where('data.0.user_id', $user->id)
            ->where('data.0.title', $prints[0]->title)
            ->where('data.0.description', $prints[0]->description)
            ->where('data.0.filament_brand_id', $prints[0]->filament_brand_id)
            ->where('data.0.filament_colour_id', $prints[0]->filament_colour_id)
            ->where('data.0.is_favourite', true)
            ->where('data.1.id', $prints[1]->id)
            ->where('data.1.user_id', $user->id)
            ->where('data.1.title', $prints[1]->title)
            ->where('data.1.description', $prints[1]->description)
            ->where('data.1.filament_brand_id', $prints[1]->filament_brand_id)
            ->where('data.1.filament_colour_id', $prints[1]->filament_colour_id)
            ->where('data.1.is_favourite', false)
            ->etc());
});

it('returns an empty collection of prints when no records exist', function () {
    asLoggedInUser()
        ->getJson(route('my.prints.index'))
        ->assertOk()
        ->assertJsonCount(0, 'data')
        ->assertJsonStructure([
            'data' => [],
        ]);
});
