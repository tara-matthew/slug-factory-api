<?php

namespace Domain\Users\Listeners;

use Domain\Users\Events\UserCreated;
use Domain\Users\Models\UserProfile;

class CreateUserProfile
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
        $userProfile = new UserProfile;
        $userProfile->user()->associate($event->user);
        $userProfile->save();
    }
}
