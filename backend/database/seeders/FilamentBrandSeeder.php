<?php

namespace Database\Seeders;

use App\Models\FilamentBrand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        FilamentBrand::factory(10)->create();
    }
}
