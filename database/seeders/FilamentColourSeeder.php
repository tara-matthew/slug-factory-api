<?php

namespace Database\Seeders;

use Domain\Filaments\Colours\Models\FilamentColour;
use Illuminate\Database\Seeder;

class FilamentColourSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FilamentColour::factory(10)->create();
    }
}
