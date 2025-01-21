<?php

namespace Domain\Notifications\DataTransferObjects;

use Domain\Notifications\Enums\NotificationChannel;
use Domain\Users\Models\User;
use Spatie\LaravelData\Data;

class NotificationData extends Data
{
    public function __construct(
        public User $user,
        public string $title,
        public string $body,
        public string $notification_type,
        public NotificationChannel $channel
    ) {
    }
}
