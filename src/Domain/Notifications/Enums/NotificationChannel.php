<?php

namespace Domain\Notifications\Enums;

enum NotificationChannel: string
{
    case PUSH = 'push';
    case MAIL = 'mail';
}
