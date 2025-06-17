<?php

use Domain\Filaments\Materials\Models\FilamentMaterial;
use Domain\Filaments\Models\PrinterFilament;
use Domain\PrintedDesigns\Models\PrintedDesign;
use Tests\TestCase;

uses(TestCase::class);

test('relations', function () {
    $filamentMaterial = FilamentMaterial::factory()->hasPrinterFilaments()->hasPrintedDesigns()->create();

    expect($filamentMaterial->printerFilaments)->each->toBeInstanceOf(PrinterFilament::class)
        ->and($filamentMaterial->printedDesigns)->each->toBeInstanceOf(PrintedDesign::class);
});
