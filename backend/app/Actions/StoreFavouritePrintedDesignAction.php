<?php

namespace App\Actions;

use App\Models\PrintedDesign;

class StoreFavouritePrintedDesignAction
{
    public function execute(PrintedDesign $printedDesign)
    {
        return $printedDesign->favourites()->create(['user_id' => auth()->id()]);
    }
}
