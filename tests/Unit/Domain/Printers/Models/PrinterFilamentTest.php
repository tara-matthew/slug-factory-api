<?php

use Domain\Filaments\Brands\Models\FilamentBrand;
use Domain\Filaments\Colours\Models\FilamentColour;
use Domain\Filaments\Materials\Models\FilamentMaterial;
use Domain\Filaments\Models\PrinterFilament;
use Tests\TestCase;

uses(TestCase::class);

test('relations', function () {
    $printerFilament = PrinterFilament::factory()->hasFavourites()->create();

    expect($printerFilament->filamentBrand)->toBeInstanceOf(FilamentBrand::class)
        ->and($printerFilament->filamentColour)->toBeInstanceOf(FilamentColour::class)
        ->and($printerFilament->filamentMaterial)->toBeInstanceOf(FilamentMaterial::class)
        ->and($printerFilament->favourites)->each->toBeInstanceOf(\Domain\Favourites\Models\Favourite::class);
});
