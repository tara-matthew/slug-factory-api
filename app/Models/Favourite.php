<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Favourite extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        "user_id"
    ];

    public function favouritable(): MorphTo
    {
        return $this->morphTo();
    }

    public function scopeByUser($query, $user)
    {
        return $query->where(
            ['user_id' => $user->id, 'favouritable_type' => 'App\Models\PrintedDesign']
        )
            ->get()
            ->pluck('favouritable');
    }
}
