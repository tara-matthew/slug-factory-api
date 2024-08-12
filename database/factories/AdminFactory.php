<?php

namespace Database\Factories;

use Domain\Admin\Models\Admin;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AdminFactory extends Factory
{
    protected $model = Admin::class;

    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$rjqKPbHkax2YsyAGwmg6Lul.e.kkkocGzrWN9A3aIqtDnQoIUJbte', // Password123!
            'remember_token' => Str::random(10),
        ];
    }
}
