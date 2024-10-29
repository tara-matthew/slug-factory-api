<?php

namespace Database\Seeders;

use Domain\Filaments\Materials\Models\FilamentMaterial;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FilamentMaterialSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        foreach (config('filaments.materials') as $brand) {
            FilamentMaterial::factory()->create([
                'name' => $brand,
            ]);
        }
    }
}
