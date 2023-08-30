<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\FilamentBrand;
use App\Models\FilamentColour;
use App\Models\PrintedDesign;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory([
            'username' => 'tara'
        ])->create();

        // TODO use UserSeeder
        User::factory(10)->create();

//        FilamentColour::factory(4)->has(PrintedDesign::factory(4)->hasImages())->create();

        $this->call([
            FilamentBrandSeeder::class,
            FilamentColourSeeder::class,
            PrintedDesignSeeder::class
        ]);
    }
}
