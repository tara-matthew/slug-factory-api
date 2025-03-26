<?php

namespace App\Http\Controllers;

use Domain\Notifications\Enums\NotificationChannel;
use Domain\Notifications\Models\Notification;
use Domain\PrintedDesigns\Notifications\PrintedDesignUploaded;
use Domain\Users\Models\User;

class PushNotificationTestController
{
    public function __invoke()
    {
        $user = User::first();
        $notification = Notification::make([
            'title' => 'test',
            'body' => 'test',
            'channel' => NotificationChannel::PUSH,
        ]);

        $user->notify(new PrintedDesignUploaded($notification));
    }
}
