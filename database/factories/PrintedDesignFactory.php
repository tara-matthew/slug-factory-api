<?php

namespace Database\Factories;

use App\Models\FilamentBrand;
use App\Models\FilamentColour;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PrintedDesign>
 */
class PrintedDesignFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(), // FOR A RANDOM USER User::inRandomOrder()->first(),
            'filament_brand_id' => FilamentBrand::inRandomOrder()->first(),
            'filament_colour_id' => FilamentColour::inRandomOrder()->first(),
            'title' => $this->faker->sentence(),
            'description' => $this->faker->text(600),
        ];
    }
}
