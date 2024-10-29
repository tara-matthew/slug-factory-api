<?php

namespace Domain\Printers\Brands\Models;

use Domain\Printers\PrinterModels\Models\PrinterModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PrinterBrand extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function printerModel(): HasMany
    {
        return $this->hasMany(PrinterModel::class);
    }
}
