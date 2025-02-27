<?php

namespace App\PrintedDesignLists\Models;

use Domain\PrintedDesigns\Models\PrintedDesign;
use Domain\Users\Models\User;
use Faker\Generator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class PrintedDesignList extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image_url',
    ];

    public function printedDesigns(): BelongsToMany
    {
        return $this->belongsToMany(PrintedDesign::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
