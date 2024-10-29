<?php

namespace Database\Seeders;

use Domain\Filaments\Brands\Models\FilamentBrand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FilamentBrandSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        // TODO could use an enum
        foreach (config('filaments.brands') as $brand) {
            FilamentBrand::factory()->create([
                'name' => $brand,
            ]);
        }
    }
}
