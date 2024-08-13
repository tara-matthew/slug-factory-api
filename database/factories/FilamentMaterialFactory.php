<?php

namespace Database\Factories;

use Domain\Filaments\Materials\Models\FilamentMaterial;
use Illuminate\Database\Eloquent\Factories\Factory;

class FilamentMaterialFactory extends Factory
{
    protected $model = FilamentMaterial::class;

    public function definition(): array
    {
        return [
            'name' => fake()->name()
        ];
    }
}
