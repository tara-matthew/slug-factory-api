<?php

namespace Domain\Filaments\Colours\Models;

use Domain\PrintedDesigns\Models\PrintedDesign;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FilamentColour extends Model
{
    use HasFactory;

    public function printedDesigns()
    {
        return $this->hasMany(PrintedDesign::class);
    }
}
