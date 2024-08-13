<?php

use Domain\Filaments\Colours\Models\FilamentColour;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\Fluent\AssertableJson;

uses(RefreshDatabase::class);

it('returns a list of filament colours', function () {
    $filamentColours = FilamentColour::factory()->count(3)->create();

    $this
        ->getJson(route('filament-colours.index'))
        ->assertOk()
        ->assertJson(fn (AssertableJson $json) => $json->has('data', 3)
            ->has('data.0', fn (AssertableJson $json) => $json->where('id', $filamentColours->first()->id)
                ->where('name', $filamentColours->first()->name)
                ->etc()
            )
            ->etc()
        );
});
