<?php

namespace Domain\Printers\PrinterModels\Models;

use Domain\Printers\Brands\Models\PrinterBrand;
use Domain\Printers\Models\Printer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PrinterModel extends Model
{
    use HasFactory;

    public function printerBrand(): BelongsTo
    {
        return $this->belongsTo(PrinterBrand::class);
    }
}
