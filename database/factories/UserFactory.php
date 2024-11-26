<?php

namespace Database\Factories;

use Domain\Users\Models\Country;
use Domain\Users\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<User>
 *
 * @method hasPrintedDesigns(int $int)
 */
class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'country_id' => Country::factory(),
            'email' => fake()->unique()->safeEmail(),
            'avatar_url' => $this->faker->imageUrl,
            'username' => fake()->userName(),
            'email_verified_at' => now(),
            'password' => '$2y$10$rjqKPbHkax2YsyAGwmg6Lul.e.kkkocGzrWN9A3aIqtDnQoIUJbte', // Password123!
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
