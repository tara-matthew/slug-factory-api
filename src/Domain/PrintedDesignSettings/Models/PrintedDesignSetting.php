<?php

namespace Domain\PrintedDesignSettings\Models;

use Domain\PrintedDesigns\Models\PrintedDesign;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PrintedDesignSetting extends Model
{
    use HasFactory;

    public function printedDesign(): BelongsTo
    {
        return $this->belongsTo(PrintedDesign::class);
    }
}
