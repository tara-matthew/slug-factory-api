<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // TODO use UserSeeder
        $this->call([
            AdminSeeder::class,
            FilamentBrandSeeder::class,
            FilamentColourSeeder::class,
            FilamentMaterialSeeder::class,
            PrinterBrandSeeder::class,
            PrinterSeeder::class,
            PrintedDesignSeeder::class,
        ]);
    }
}
