<?php

namespace Database\Seeders;

use Domain\Filaments\Brands\Models\FilamentBrand;
use Domain\Filaments\Colours\Models\FilamentColour;
use Domain\Filaments\Materials\Models\FilamentMaterial;
use Domain\PrintedDesigns\Models\PrintedDesign;
use Domain\Users\Models\Country;
use Domain\Users\Models\User;
use Illuminate\Database\Seeder;

class PrintedDesignSeeder extends Seeder
{
    public function run(): void
    {
        $brands = FilamentBrand::all();
        $colours = FilamentColour::all();
        $materials = FilamentMaterial::all();
        $countries = Country::all();

        for ($i = 0; $i < 2000; $i++) {
            $user = User::factory()
                ->for($countries->random())
                ->create();
            PrintedDesign::factory()
                ->for($brands->random())
                ->for($colours->random())
                ->for($materials->random())
                ->for($user)
                ->hasMasterImages(5)
                ->hasFavourites(['user_id' => $user->id])
                ->hasPrintedDesignSetting()
                ->create();
        }
    }
}
