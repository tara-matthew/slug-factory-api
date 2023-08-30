<?php

namespace Database\Seeders;

use App\Models\FilamentColour;
use App\Models\PrintedDesign;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
