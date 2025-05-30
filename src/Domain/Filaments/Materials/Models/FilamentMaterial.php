<?php

namespace Domain\Filaments\Materials\Models;

use Domain\Filaments\Models\PrinterFilament;
use Domain\PrintedDesigns\Models\PrintedDesign;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FilamentMaterial extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function printedDesigns(): HasMany
    {
        return $this->hasMany(PrintedDesign::class);
    }

    public function printerFilaments(): HasMany
    {
        return $this->hasMany(PrinterFilament::class);
    }
}
