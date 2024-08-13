<?php

namespace Database\Seeders;

use Domain\Printers\Brands\Models\PrinterBrand;
use Domain\Printers\PrinterModels\Models\PrinterModel;
use Illuminate\Database\Seeder;

class PrinterBrandSeeder extends Seeder
{
    public function run(): void
    {
        foreach (config('printers.brands') as $name => $brand) {
            $printerBrand = PrinterBrand::factory()->create(['name' => $name]);
            foreach ($brand as $model) {
                PrinterModel::factory()->for($printerBrand)->create(['name' => $model]);
            }
        }
    }
}
