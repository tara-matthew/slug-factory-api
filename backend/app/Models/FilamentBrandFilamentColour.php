<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class FilamentBrandFilamentColour extends Pivot
{
    use HasFactory;

    public $incrementing = true;

    protected $table = 'filament_brand_filament_colour';

    public function printedDesigns()
    {
        return $this->hasMany(PrintedDesign::class);
    }

//    public function brand()
//    {
//        return $this->belongsTo(FilamentBrand::class, 'filament_brand_id'); // Adjust the foreign key column name if needed
//    }
}
