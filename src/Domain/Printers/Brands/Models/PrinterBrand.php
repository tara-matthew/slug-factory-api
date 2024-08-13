<?php

namespace Domain\Printers\Brands\Models;

use Domain\Printers\PrinterModels\Models\PrinterModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrinterBrand extends Model
{
    use HasFactory;

    public function printerModel()
    {
        return $this->hasMany(PrinterModel::class);
    }
}
