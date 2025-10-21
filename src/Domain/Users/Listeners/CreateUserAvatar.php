<?php

declare(strict_types=1);

namespace Domain\Users\Listeners;

use Domain\Users\Events\UserCreated;
use Faker\Generator;

class CreateUserAvatar
{
    public function __construct()
    {
        //
    }

    public function handle(UserCreated $event): void
    {
        $faker = app(Generator::class);
        $event->user->avatar_url = $faker->imageUrl;
        $event->user->save();
    }
}
