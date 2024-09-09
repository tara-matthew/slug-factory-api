<?php

namespace Database\Factories;

use Domain\Users\Models\Country;
use Illuminate\Database\Eloquent\Factories\Factory;

class CountryFactory extends Factory
{
    protected $model = Country::class;

    public function definition(): array
    {
        return [
            'name' => fake()->country(),
        ];
    }
}
