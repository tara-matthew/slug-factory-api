<?php

namespace App\Actions;

use App\Models\Favourite;
use App\Models\PrintedDesign;
use Illuminate\Database\Eloquent\Model;

class StoreFavouritePrintedDesignAction
{
    public function execute(PrintedDesign $printedDesign): Model
    {
        return $printedDesign->favourites()->create(['user_id' => auth()->id()]);
    }
}
