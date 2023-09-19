<?php

namespace App\Http\Controllers;

use App\Actions\StoreFavouritePrintedDesignAction;
use App\DataTransferObjects\FavouritePrintedDesignData;
use App\Models\PrintedDesign;
use Illuminate\Http\Request;

class FavouritePrintedDesignController extends Controller
{
    public function store(PrintedDesign $printedDesign, StoreFavouritePrintedDesignAction $storeFavouritePrintedDesignAction)
    {
        return $storeFavouritePrintedDesignAction->execute($printedDesign);
        // Store printed design action execute
//        $favouriteData = new FavouritePrintedDesignData($printedDesign); //PrintedDesignDataFactory::fromRequest($request);
//        return $favourite;
//
//        $favourite = $storeFavouritePrintedDesignAction->execute($favouriteData);

//        $printedDesign->favourites()->create(['user_id' => auth()->id()]);
    }

    public function destroy(PrintedDesign $printedDesign)
    {
    }
}
