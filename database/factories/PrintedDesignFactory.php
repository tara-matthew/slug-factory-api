<?php

namespace Database\Factories;

use Domain\Filaments\Brands\Models\FilamentBrand;
use Domain\Filaments\Colours\Models\FilamentColour;
use Domain\PrintedDesigns\Models\PrintedDesign;
use Domain\Users\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Domain\Favourites\PrintedDesign>
 */
class PrintedDesignFactory extends Factory
{
    protected $model = PrintedDesign::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(), // FOR A RANDOM USER User::inRandomOrder()->first(),
            'filament_brand_id' => count(FilamentBrand::all()) ? FilamentBrand::inRandomOrder()->first() : FilamentBrand::factory(),
            'filament_colour_id' => count(FilamentColour::all()) ? FilamentColour::inRandomOrder()->first() : FilamentColour::factory(),
            'title' => $this->faker->sentence(),
            'description' => $this->faker->text(600),
        ];
    }
}
