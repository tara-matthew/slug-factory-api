<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Domain\Users\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory([
            'username' => 'tara',
        ])->create();

        // TODO use UserSeeder
        $this->call([
            AdminSeeder::class,
            FilamentBrandSeeder::class,
            FilamentColourSeeder::class,
            FilamentMaterialSeeder::class,
            PrinterFilamentSeeder::class,
            PrinterBrandSeeder::class,
            PrinterSeeder::class,
            CountrySeeder::class,
            PrintedDesignSeeder::class,
            UserProfileSeeder::class,
        ]);
    }
}
