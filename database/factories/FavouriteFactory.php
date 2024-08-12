<?php

namespace Database\Factories;

use Domain\Favourites\Models\Favourite;
use Domain\Users\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class FavouriteFactory extends Factory
{
    protected $model = Favourite::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
        ];
    }
}
