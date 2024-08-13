<?php

namespace Database\Factories;

use Domain\Printers\Brands\Models\PrinterBrand;
use Domain\Printers\PrinterModels\Models\PrinterModel;
use Illuminate\Database\Eloquent\Factories\Factory;

class PrinterModelFactory extends Factory
{
    protected $model = PrinterModel::class;

    public function definition(): array
    {
        return [
            'printer_brand_id' => PrinterBrand::factory(),
            'name' => fake()->name()
        ];
    }
}
