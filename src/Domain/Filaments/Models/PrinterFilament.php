<?php

namespace Domain\Filaments\Models;

use App\Filaments\Resources\PrinterFilamentResource;
use Domain\Favourites\Models\Favourite;
use Domain\Filaments\Brands\Models\FilamentBrand;
use Domain\Filaments\Colours\Models\FilamentColour;
use Domain\Filaments\Materials\Models\FilamentMaterial;
use Domain\Shared\Traits\CanBeFavourited;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Casts\Attribute;

class PrinterFilament extends Model
{
    use HasFactory;
    use CanBeFavourited;

    public function filamentBrand(): BelongsTo
    {
        return $this->belongsTo(FilamentBrand::class);
    }

    public function filamentColour(): BelongsTo
    {
        return $this->belongsTo(FilamentColour::class);
    }

    public function filamentMaterial(): BelongsTo
    {
        return $this->belongsTo(FilamentMaterial::class);
    }

    public function favourites(): MorphMany
    {
        return $this->morphMany(Favourite::class, 'favouritable');
    }

    public function toResource(): PrinterFilamentResource
    {
        return new PrinterFilamentResource($this);
    }

    protected function title(): Attribute
    {
        return Attribute::make(
            get: fn () => "{$this->filamentBrand->name} {$this->filamentColour->name} {$this->filamentMaterial->name}"
        );
    }
}
