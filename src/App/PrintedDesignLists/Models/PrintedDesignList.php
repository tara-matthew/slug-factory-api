<?php

namespace App\PrintedDesignLists\Models;

use Domain\PrintedDesigns\Models\PrintedDesign;
use Domain\Users\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class PrintedDesignList extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'image_url',
    ];

    public function printedDesigns(): BelongsToMany
    {
        return $this->belongsToMany(PrintedDesign::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopeWhereContainsPrintedDesign($query, PrintedDesign $printedDesign): BelongsToMany
    {
        return $query->whereHas('printedDesigns', function ($query) use ($printedDesign) {
            $query->where('printed_design_id', $printedDesign->id);
        });
    }

    public function containsPrintedDesign(PrintedDesign $printedDesign): bool
    {
        return $this->printedDesigns()->where('printed_design_id', $printedDesign->id)->exists();
    }
}
