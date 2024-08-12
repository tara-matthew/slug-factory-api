<?php

namespace Database\Seeders;

use Domain\Filaments\Colours\Models\FilamentColour;
use Illuminate\Database\Seeder;

class FilamentColourSeeder extends Seeder
{
    public function run(): void
    {
        FilamentColour::factory(10)->create();
    }
}
