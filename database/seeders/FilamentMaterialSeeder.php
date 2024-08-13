<?php

namespace Database\Seeders;

use Domain\Filaments\Materials\Models\FilamentMaterial;
use Illuminate\Database\Seeder;

class FilamentMaterialSeeder extends Seeder
{
    public function run(): void
    {
        foreach (config('filaments.materials') as $brand) {
            FilamentMaterial::factory()->create([
                'name' => $brand,
            ]);
        }
    }
}
