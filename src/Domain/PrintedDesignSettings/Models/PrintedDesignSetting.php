<?php

namespace Domain\PrintedDesignSettings\Models;

use Domain\PrintedDesigns\Models\PrintedDesign;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PrintedDesignSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'infill_percentage',
        'print_speed',
        'nozzle_size',
        'uses_supports',
        'uses_raft',
        'uses_brim',
    ];

    protected $casts = [
        'uses_supports' => 'boolean'
    ];

    public function printedDesign(): BelongsTo
    {
        return $this->belongsTo(PrintedDesign::class);
    }
}
