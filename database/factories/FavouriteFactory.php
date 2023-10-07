<?php

namespace Database\Factories;

use Domain\Favourites\Models\Favourite;
use Domain\Users\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Favourite>
 */
class FavouriteFactory extends Factory
{
    protected $model = Favourite::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => User::factory()->create()
        ];
    }
}
