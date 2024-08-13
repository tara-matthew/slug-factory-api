<?php

namespace Database\Factories;

use Domain\Printers\Models\Printer;
use Domain\Printers\PrinterModels\Models\PrinterModel;
use Illuminate\Database\Eloquent\Factories\Factory;

class PrinterFactory extends Factory
{
    protected $model = Printer::class;

    public function definition(): array
    {
        return [
            'printer_model_id' => PrinterModel::factory(),
        ];
    }
}
