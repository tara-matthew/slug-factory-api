<?php

namespace Database\Factories;

use Domain\Filaments\Brands\Models\FilamentBrand;
use Domain\Filaments\Colours\Models\FilamentColour;
use Domain\PrintedDesigns\Models\PrintedDesign;
use Domain\Users\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PrintedDesignFactory extends Factory
{
    protected $model = PrintedDesign::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(), // FOR A RANDOM USER User::inRandomOrder()->first(),
            'filament_brand_id' => FilamentBrand::factory(),
            'filament_colour_id' => FilamentColour::factory(),
            'title' => fake()->productName,
            'description' => $this->faker->text(600),
        ];
    }
}
