<?php

namespace Domain\Users\Listeners;

use Domain\Users\Events\UserCreated;

class CreateUserAvatar
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
    public function handle(UserCreated $event): void {}
}
