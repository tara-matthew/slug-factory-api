<?php

namespace Database\Factories;

use App\Models\FilamentBrand;
use App\Models\FilamentColour;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FilamentBrandFilamentColour>
 */
class FilamentBrandFilamentColourFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'filament_brand_id' => FilamentBrand::factory(),
            'filament_colour_id' => FilamentColour::factory()
        ];
    }
}
