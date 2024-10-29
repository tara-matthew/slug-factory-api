<?php

namespace Database\Factories;

use Domain\Filaments\Brands\Models\FilamentBrand;
use Domain\Filaments\Colours\Models\FilamentColour;
use Domain\Filaments\Materials\Models\FilamentMaterial;
use Domain\Filaments\Models\PrinterFilament;
use Illuminate\Database\Eloquent\Factories\Factory;

class PrinterFilamentFactory extends Factory
{
    protected $model = PrinterFilament::class;

    public function definition(): array
    {
        return [
            'filament_brand_id' => FilamentBrand::factory(),
            'filament_material_id' => FilamentMaterial::factory(),
            'filament_colour_id' => FilamentColour::factory(),
            'image_url' => $this->faker->imageUrl,
        ];
    }
}
