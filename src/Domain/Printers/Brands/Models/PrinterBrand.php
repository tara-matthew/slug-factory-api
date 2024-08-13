<?php

namespace Domain\Printers\Brands\Models;

use Domain\Printers\Models\Printer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PrinterBrand extends Model
{
    use HasFactory;

    public function printer(): HasOne
    {
        return $this->hasOne(Printer::class);
    }
}
