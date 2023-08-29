<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class FilamentBrand extends Model
{
    use HasFactory;

//    public function printedDesigns(): BelongsToMany
//    {
//        return $this->belongsToMany(PrintedDesign::class);
//    }

    public function filamentColours(): BelongsToMany
    {
        return $this->belongsToMany(FilamentColour::class)->using(FilamentBrandFilamentColour::class);
    }

//    public function filamentColors()
//    {
//        return $this->hasMany(FilamentBrandFilamentColour::class, 'filament_brand_id'); // Adjust the foreign key column name if needed
//    }
}
