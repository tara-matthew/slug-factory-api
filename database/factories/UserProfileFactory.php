<?php

declare(strict_types=1);

namespace Database\Factories;

use Domain\Users\Models\User;
use Domain\Users\Models\UserProfile;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserProfileFactory extends Factory
{
    protected $model = UserProfile::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'bio' => fake()->paragraph(),
        ];
    }
}
