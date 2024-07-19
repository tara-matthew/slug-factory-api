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
        $user = User::factory([
            'username' => 'tara',
        ])->create();
//        Favourite::factory(['user_id' => $user->id])->for(
//            PrintedDesign::factory(),
//            'favouritable'
//        )->create();

        // TODO use UserSeeder
//        User::factory(10)->create();

        //        FilamentColour::factory(4)->has(PrintedDesign::factory(4)->hasImages())->create();

        $this->call([
            AdminSeeder::class,
            FilamentBrandSeeder::class,
            FilamentColourSeeder::class,
            PrintedDesignSeeder::class,
        ]);
    }
}
