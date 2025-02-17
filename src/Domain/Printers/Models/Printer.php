<?php

namespace Domain\Printers\Models;

use Domain\Favourites\Models\Favourite;
use Domain\Printers\PrinterModels\Models\PrinterModel;
use Domain\Shared\Traits\CanBeFavourited;
use Domain\Users\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Printer extends Model
{
    use CanBeFavourited;
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function printerModel(): BelongsTo
    {
        return $this->belongsTo(PrinterModel::class);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function favourites(): MorphMany // TODO could move into the trait
    {
        return $this->morphMany(Favourite::class, 'favouritable');
    }
}
