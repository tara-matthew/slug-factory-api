<?php

namespace Database\Seeders;

use App\Models\PrintedDesign;
use Illuminate\Database\Seeder;

class PrintedDesignSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PrintedDesign::factory(30)->hasImages(3)->hasFavourites()->create();
    }
}
