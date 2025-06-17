<?php

use Domain\Filaments\Colours\Models\FilamentColour;
use Domain\Filaments\Models\PrinterFilament;
use Domain\PrintedDesigns\Models\PrintedDesign;
use Tests\TestCase;

uses(TestCase::class);

test('relations', function () {
    $filamentColour = FilamentColour::factory()->hasPrinterFilaments()->hasPrintedDesigns()->create();

    expect($filamentColour->printerFilaments)->each->toBeInstanceOf(PrinterFilament::class)
        ->and($filamentColour->printedDesigns)->each->toBeInstanceOf(PrintedDesign::class);
});
