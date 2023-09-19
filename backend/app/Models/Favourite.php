<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Favourite extends Model
{
	public $timestamps = false;

    use HasFactory;

    protected $fillable = [
        "user_id"
    ];

    public function favouritable(): MorphTo
    {
        return $this->morphTo();
    }
}
