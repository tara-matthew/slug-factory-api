<?php

namespace Database\Seeders;

use App\PrintedDesignLists\Models\PrintedDesignList;
use Domain\Users\Models\User;
use Domain\Users\Models\UserProfile;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PrintedDesignListSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $users = User::all();

        foreach ($users as $user) {
            PrintedDesignList::factory()->for($user)->create([
                'name' => "To Print",
            ]);
            PrintedDesignList::factory()->for($user)->create([
                'name' => "Printed",
            ]);
        }
    }
}
