<?php

namespace Domain\Filaments\Brands\Models;

use App\Filaments\Brands\Resources\FilamentBrandResource;
use Domain\Favourites\Models\Favourite;
use Domain\Filaments\Models\PrinterFilament;
use Domain\PrintedDesigns\Models\PrintedDesign;
use Domain\Shared\Traits\CanBeFavourited;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class FilamentBrand extends Model
{
    use CanBeFavourited;
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

    public function favourites(): MorphMany
    {
        return $this->morphMany(Favourite::class, 'favouritable');
    }

    public function toResource(): FilamentBrandResource
    {
        return new FilamentBrandResource($this);
    }
}
