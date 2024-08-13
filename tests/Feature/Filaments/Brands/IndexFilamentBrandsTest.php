<?php

namespace Tests\Feature\Filaments\Brands;

use Domain\Filaments\Brands\Models\FilamentBrand;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\Fluent\AssertableJson;

uses(RefreshDatabase::class);

it('returns a list of filament brands', function () {
    $filamentBrands = FilamentBrand::factory()->count(3)->create();

    $this
        ->getJson(route('filament-brands.index'))
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
        ->getJson(route('filament-brands.index'))
        ->assertOk()
        ->assertJsonCount(0, 'data')
        ->assertJsonStructure([
            'data' => [],
        ]);
});
