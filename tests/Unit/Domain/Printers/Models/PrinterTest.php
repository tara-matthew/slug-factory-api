<?php

use Domain\Favourites\Models\Favourite;
use Domain\Printers\Models\Printer;
use Domain\Printers\PrinterModels\Models\PrinterModel;
use Domain\Users\Models\User;
use Tests\TestCase;

uses(TestCase::class);

test('relations', function () {
    $users = User::factory()->count(3)->create();
    $printer = Printer::factory()->hasFavourites()->hasAttached($users)->create();

    expect($printer->users)->each->toBeInstanceOf(User::class)
        ->and($printer->printerModel)->toBeInstanceOf(PrinterModel::class)
        ->and($printer->favourites)->each->toBeInstanceOf(Favourite::class);
});
