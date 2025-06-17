<?php

use Domain\Favourites\Models\Favourite;
use Domain\Filaments\Brands\Models\FilamentBrand;
use Domain\Filaments\Models\PrinterFilament;
use Domain\PrintedDesigns\Models\PrintedDesign;
use Tests\TestCase;

uses(TestCase::class);

test('relations', function () {
    $filamentBrand = FilamentBrand::factory()->hasPrinterFilaments()->hasFavourites()->hasPrintedDesigns()->create();

    expect($filamentBrand->printerFilaments)->each->toBeInstanceOf(PrinterFilament::class)
        ->and($filamentBrand->printedDesigns)->each->toBeInstanceOf(PrintedDesign::class)
        ->and($filamentBrand->favourites)->each->toBeInstanceOf(Favourite::class);
});
