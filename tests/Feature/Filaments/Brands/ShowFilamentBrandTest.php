<?php

use Domain\Filaments\Brands\Models\FilamentBrand;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\Fluent\AssertableJson;

uses(RefreshDatabase::class);

it('returns a specific filament brand', function () {
    $filamentBrand = FilamentBrand::factory()->create();

    $this
        ->getJson(route('filament-brands.show', $filamentBrand))
        ->assertOk()
        ->assertJson(fn (AssertableJson $json) => $json
            ->where('data.id', $filamentBrand->id)
            ->where('data.name', $filamentBrand->name)
        );
});
