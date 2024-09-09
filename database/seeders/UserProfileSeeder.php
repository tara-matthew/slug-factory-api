<?php

namespace Database\Seeders;

use Domain\Users\Models\User;
use Domain\Users\Models\UserProfile;
use Illuminate\Database\Seeder;

class UserProfileSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();

        foreach ($users as $user) {
            UserProfile::factory()->for($user)->create();
        }
    }
}
