<?php

namespace Domain\Favourites\Models;

use Domain\Users\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Favourite extends Model
{
    use HasFactory;

    protected $fillable = [
//        'user_id',
    ];

    public function favouritable(): MorphTo
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // TODO set up proper relationship with user

    public function scopeByUser($query, $user)
    {
        return $query->where('user_id', $user->id)
            ->where('favouritable_type','Domain\PrintedDesigns\Models\PrintedDesign')
            ->with('favouritable')
            ->get()
            ->pluck('favouritable');
    }
}
