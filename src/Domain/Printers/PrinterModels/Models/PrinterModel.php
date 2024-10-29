<?php

namespace Domain\Printers\PrinterModels\Models;

use Domain\Printers\Brands\Models\PrinterBrand;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PrinterModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function printerBrand(): BelongsTo
    {
        return $this->belongsTo(PrinterBrand::class);
    }
}
