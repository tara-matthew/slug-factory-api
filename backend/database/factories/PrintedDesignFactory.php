<?php

namespace Database\Factories;

use App\Models\FilamentBrandFilamentColour;
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
            'brand_colour_id' => FilamentBrandFilamentColour::factory(),
            'title' => $this->faker->sentence(),
            'description' => $this->faker->text(600)
        ];
    }
}
