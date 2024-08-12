<?php

namespace Database\Seeders;

use Domain\Filaments\Brands\Models\FilamentBrand;
use Illuminate\Database\Seeder;

class FilamentBrandSeeder extends Seeder
{
    public function run()
    {
        // TODO could use an enum
        foreach (config('filaments.brands') as $brand) {
            FilamentBrand::factory()->create([
                'name' => $brand,
            ]);
        }
    }
}
