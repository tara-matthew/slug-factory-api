<?php

namespace Database\Seeders;

use Domain\Users\Models\Country;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    public function run(): void
    {
        Country::factory(20)->create();
    }
}
