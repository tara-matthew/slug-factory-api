<?php

namespace Domain\Users\Listeners;

use App\PrintedDesignLists\Models\PrintedDesignList;
use Domain\Users\Events\UserCreated;
use Faker\Generator;

class CreateUserDefaultLists
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserCreated $event): void
    {
        $faker = app(Generator::class);

        foreach (config('default-user-lists') as $listTitle) {
            $printedDesignList = new PrintedDesignList([
                'title' => $listTitle,
                'image_url' => $faker->imageUrl,
            ]);
            $printedDesignList->user()->associate($event->user);
            $printedDesignList->save();
        }
    }
}
