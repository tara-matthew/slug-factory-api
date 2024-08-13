<?php

namespace Tests\Feature\Filaments\Brands;

use Domain\Filaments\Brands\Models\FilamentBrand;
use Illuminate\Testing\Fluent\AssertableJson;

it('returns a list of filament brands', function () {
    $filamentBrands = FilamentBrand::factory()->count(3)->create();

    $this
        ->getJson('api/filament-brands')
        ->assertOk()
        ->assertJson(fn (AssertableJson $json) => $json->has('data', 3)
            ->has('data.0', fn (AssertableJson $json) => $json->where('id', $filamentBrands->first()->id)
                ->where('name', $filamentBrands->first()->name)
                ->etc()
            )
            ->etc()
        );
});

it('returns an empty collection of filament brands when none exist', function () {
    $this
        ->getJson('api/filament-brands')
        ->assertOk()
        ->assertJsonCount(0, 'data')
        ->assertJsonStructure([
            'data' => [],
        ]);
});
