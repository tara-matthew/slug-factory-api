<?php

namespace Database\Seeders;

use Domain\Printers\Models\Printer;
use Domain\Printers\PrinterModels\Models\PrinterModel;
use Illuminate\Database\Seeder;

class PrinterSeeder extends Seeder
{
    public function run(): void
    {
        $printerModels = PrinterModel::all();

        foreach ($printerModels as $printerModel) {
            Printer::factory()->for($printerModel)->create();
        }
    }
}
