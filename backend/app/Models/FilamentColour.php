<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class FilamentColour extends Model
{
    use HasFactory;

    public function filamentBrands(): BelongsToMany
    {
        return $this->belongsToMany(FilamentBrand::class)->using(FilamentBrandFilamentColour::class);
    }
}
