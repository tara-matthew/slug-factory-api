<?php

namespace Database\Factories;

use Domain\Filaments\Colours\Models\FilamentColour;
use Illuminate\Database\Eloquent\Factories\Factory;

class FilamentColourFactory extends Factory
{
    protected $model = FilamentColour::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique(false, 50000)->safeColorName,
        ];
    }
}
