<?php

namespace Database\Seeders;

use App\PrintedDesignLists\Models\PrintedDesignList;
use Domain\Users\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PrintedDesignListSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $users = User::all();

        foreach ($users as $user) {
            foreach (config('default-user-lists') as $listTitle) {
                PrintedDesignList::factory()->for($user)->create([
                    'title' => $listTitle,
                ]);
            }
        }
    }
}
