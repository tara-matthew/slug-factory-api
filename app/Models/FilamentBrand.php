<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class FilamentBrand extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function printedDesigns()
    {
        return $this->hasMany(PrintedDesign::class);
    }

    public function favourites(): MorphMany
    {
        return $this->morphMany(Favourite::class, 'favouritable');
    }
}
