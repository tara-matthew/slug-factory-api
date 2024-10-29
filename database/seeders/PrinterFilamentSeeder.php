<?php

namespace Database\Seeders;

use Domain\Filaments\Brands\Models\FilamentBrand;
use Domain\Filaments\Colours\Models\FilamentColour;
use Domain\Filaments\Materials\Models\FilamentMaterial;
use Domain\Filaments\Models\PrinterFilament;
use Domain\Users\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PrinterFilamentSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $brands = FilamentBrand::all();
        $colours = FilamentColour::all();
        $materials = FilamentMaterial::all();
        $users = User::all();

        foreach ($brands as $brand) {
            foreach ($colours as $colour) {
                foreach ($materials as $material) {
                    PrinterFilament::factory()
                        ->for($brand)
                        ->for($colour)
                        ->for($material)
                        ->hasFavourites(['user_id' => $users->random()->id])
                        ->create();
                }
            }
        }
    }
}
