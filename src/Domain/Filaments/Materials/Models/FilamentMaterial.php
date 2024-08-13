<?php

namespace Domain\Filaments\Materials\Models;

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
}
