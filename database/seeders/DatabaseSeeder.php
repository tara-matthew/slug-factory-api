<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Domain\Favourites\Models\Favourite;
use Domain\PrintedDesigns\Models\PrintedDesign;
use Domain\Users\Models\User;
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
            PrintedDesignSeeder::class,
        ]);
    }
}
