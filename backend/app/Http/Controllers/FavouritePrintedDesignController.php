<?php

namespace App\Http\Controllers;

use App\Actions\StoreFavouritePrintedDesignAction;
use App\DataTransferObjects\FavouritePrintedDesignData;
use App\Http\Resources\FavouriteResource;
use App\Http\Resources\PrintedDesignResource;
use App\Models\Favourite;
use App\Models\PrintedDesign;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class FavouritePrintedDesignController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return PrintedDesignResource::collection(Favourite::byUser());
    }
    public function store(PrintedDesign $printedDesign, StoreFavouritePrintedDesignAction $storeFavouritePrintedDesignAction): FavouriteResource
    {
        $favourite = $storeFavouritePrintedDesignAction->execute($printedDesign);

        return new FavouriteResource($favourite);
    }

    public function destroy(PrintedDesign $printedDesign)
    {
    }
}
