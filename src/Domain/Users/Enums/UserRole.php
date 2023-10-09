<?php

namespace Domain\Users\Enums;

enum UserRole: string
{
    case admin = 'admin';
    case user = 'user';
}
