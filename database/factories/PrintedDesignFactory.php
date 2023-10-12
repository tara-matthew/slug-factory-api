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
    public function definition(): array
    {
        return [
            'user_id' => User::factory(), // FOR A RANDOM USER User::inRandomOrder()->first(),
            'filament_brand_id' => $this->filamentBrandToCreate(),
            'filament_colour_id' => $this->filamentColourToCreate(),
            'title' => $this->faker->sentence(),
            'description' => $this->faker->text(600),
        ];
    }

    private function filamentBrandToCreate(): Factory|FilamentBrand
    {
        if (count(FilamentBrand::all())) {
            return FilamentBrand::inRandomOrder()->first();
        }

        return FilamentBrand::factory();
    }

    private function filamentColourToCreate(): Factory|FilamentColour
    {
        if (count(FilamentColour::all())) {
            return FilamentColour::inRandomOrder()->first();
        }

        return FilamentColour::factory();
    }
}
