<?php

declare(strict_types=1);

namespace Domain\Admin\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User;

class Admin extends User
{
    use HasFactory;
}
