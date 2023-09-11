<?php

namespace Database\Seeders;

use App\Models\FilamentBrand;
use Illuminate\Database\Seeder;

class FilamentBrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (config('filaments.brands') as $brand) {
            FilamentBrand::factory()->create([
                'name' => $brand,
            ]);
        }
    }
}
