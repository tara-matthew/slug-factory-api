<?php

namespace App\PrintedDesignLists\Models;

use Domain\PrintedDesigns\Models\PrintedDesign;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class PrintedDesignList extends Model
{
    use HasFactory;

    public function printedDesigns(): BelongsToMany
    {
        return $this->belongsToMany(PrintedDesign::class);
    }
}
