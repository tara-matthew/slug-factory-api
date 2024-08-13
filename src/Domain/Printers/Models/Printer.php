<?php

namespace Domain\Printers\Models;

use Domain\Printers\Brands\Models\PrinterBrand;
use Domain\Users\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Printer extends Model
{
    use HasFactory;

    public function printerBrand(): BelongsTo
    {
        return $this->belongsTo(PrinterBrand::class);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
}
