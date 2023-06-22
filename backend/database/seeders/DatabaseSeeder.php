<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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

        User::factory(10)->create();
        PrintedDesign::factory(5)->hasImages()->create();

        $this->call([
            FilamentBrandSeeder::class,
            FilamentColourSeeder::class
        ]);
    }
}
