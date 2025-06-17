<?php

use Domain\Printers\Brands\Models\PrinterBrand;
use Domain\Printers\PrinterModels\Models\PrinterModel;
use Tests\TestCase;

uses(TestCase::class);

test('relations', function () {
    $printerModels = PrinterModel::factory()->count(2)->forPrinterBrand()->create();

    $printerModels->each(function (PrinterModel $printerModel) {
        expect($printerModel->printerBrand)->toBeInstanceOf(PrinterBrand::class);
    });
});
