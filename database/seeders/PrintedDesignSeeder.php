<?php

namespace Database\Seeders;

use Domain\Filaments\Brands\Models\FilamentBrand;
use Domain\Filaments\Colours\Models\FilamentColour;
use Domain\PrintedDesigns\Models\PrintedDesign;
use Illuminate\Database\Seeder;

class PrintedDesignSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $brands = FilamentBrand::all();
        $colours = FilamentColour::all();

        for ($i = 0; $i < 30; $i++) {
            PrintedDesign::factory()
                ->recycle($brands->random())
                ->recycle($colours->random())
                ->hasImages()
                ->hasFavourites()
                ->create();
        }
    }
}
