<?php

namespace Database\Factories;

use Domain\Filaments\Brands\Models\FilamentBrand;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Domain\Favourites\FilamentBrand>
 */
class FilamentBrandFactory extends Factory
{
    protected $model = FilamentBrand::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
        ];
    }
}
