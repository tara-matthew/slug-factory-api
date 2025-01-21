<?php

namespace Domain\Notifications\Models;

use Domain\Users\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Notification extends Model
{
    protected $fillable = [
        'title',
        'body',
        'channel',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
