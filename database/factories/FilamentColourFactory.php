<?php

namespace Database\Factories;

use Domain\Filaments\Colours\Models\FilamentColour;
use Illuminate\Database\Eloquent\Factories\Factory;

class FilamentColourFactory extends Factory
{
    protected $model = FilamentColour::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->unique(false, 50000)->safeColorName,
        ];
    }
}
