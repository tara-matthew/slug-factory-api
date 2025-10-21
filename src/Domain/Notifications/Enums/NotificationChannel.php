<?php

declare(strict_types=1);

namespace Domain\Notifications\Enums;

enum NotificationChannel: string
{
    case PUSH = 'push';
    case MAIL = 'mail';
}
