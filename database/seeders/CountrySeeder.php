<?php

namespace Database\Seeders;

use Domain\Users\Models\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        Country::factory(20)->create();
    }
}
