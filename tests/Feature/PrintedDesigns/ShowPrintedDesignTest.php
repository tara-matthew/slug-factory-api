<?php

namespace Tests\Feature\PrintedDesigns;

use Domain\PrintedDesigns\Models\PrintedDesign;
use Domain\Users\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\Fluent\AssertableJson;

uses(RefreshDatabase::class);

it('returns a specific print', function () {
    $user = User::factory()->create();

    $print = PrintedDesign::factory()->for($user)->create();
    asLoggedInUser()
        ->getJson(route('prints.show', ['printedDesign' => $print]))
        ->assertStatus(200)
        ->assertJson(fn (AssertableJson $json) => $json
            ->where('data.id', $print->id)
            ->where('data.user_id', $user->id)
            ->where('data.title', $print->title)
            ->where('data.description', $print->description)
            ->where('data.filament_brand.name', $print->filamentBrand->name)
            ->where('data.filament_colour.name', $print->filamentColour->name)
            ->where('data.filament_material.name', $print->filamentMaterial->name)
        );
});
