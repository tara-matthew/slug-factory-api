<?php

namespace Domain\Notifications\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
        'title',
        'body',
        'channel',
    ];
}
