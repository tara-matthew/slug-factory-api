<?php

use Domain\Printers\Brands\Models\PrinterBrand;
use Domain\Printers\PrinterModels\Models\PrinterModel;
use Tests\TestCase;

uses(TestCase::class);

test('relations', function () {
    $printerBrand = PrinterBrand::factory()->hasPrinterModels()->create();

    expect($printerBrand->printerModels)->each->toBeInstanceOf(PrinterModel::class);
});
