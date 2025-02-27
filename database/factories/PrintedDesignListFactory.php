<?php

namespace Database\Factories;

use App\PrintedDesignLists\Models\PrintedDesignList;
use Domain\Users\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PrintedDesignListFactory extends Factory
{
    protected $model = PrintedDesignList::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'title' => fake()->name,
            'image_url' => $this->faker->imageUrl,
        ];
    }
}
