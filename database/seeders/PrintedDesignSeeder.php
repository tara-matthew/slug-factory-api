<?php

namespace Database\Seeders;

use Domain\Favourites\Models\Favourite;
use Domain\Filaments\Brands\Models\FilamentBrand;
use Domain\Filaments\Colours\Models\FilamentColour;
use Domain\PrintedDesigns\Models\PrintedDesign;
use Domain\Users\Models\User;
use Illuminate\Database\Seeder;

class PrintedDesignSeeder extends Seeder
{
    public function run(): void
    {
        $brands = FilamentBrand::all();
        $colours = FilamentColour::all();

        for ($i = 0; $i < 30; $i++) {
            $user = User::factory()->create();
            PrintedDesign::factory()
                ->for($brands->random())
                ->for($colours->random())
                ->for($user)
                ->hasImages()
                ->hasFavourites(['user_id' => $user->id])
                ->create();
        }
    }
}
