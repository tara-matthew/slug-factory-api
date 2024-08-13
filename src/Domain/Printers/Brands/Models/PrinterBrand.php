<?php

namespace Domain\Printers\Brands\Models;

use Domain\Printers\Models\Printer;
use Domain\Printers\PrinterModels\Models\PrinterModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PrinterBrand extends Model
{
    use HasFactory;

    public function printerModel()
    {
        return $this->hasMany(PrinterModel::class);
    }
}
