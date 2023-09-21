<?php

namespace App\Http\Controllers;

use App\Actions\StoreFavouritePrintedDesignAction;
use App\DataTransferObjects\FavouritePrintedDesignData;
use App\Http\Resources\FavouriteResource;
use App\Http\Resources\PrintedDesignResource;
use App\Models\Favourite;
use App\Models\PrintedDesign;
use App\Models\User;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class FavouritePrintedDesignController extends Controller
{
    public function index(User $user): AnonymousResourceCollection
    {
        return PrintedDesignResource::collection(Favourite::byUser($user));
    }
    public function update(User $user, PrintedDesign $printedDesign, StoreFavouritePrintedDesignAction $storeFavouritePrintedDesignAction): FavouriteResource
    {
        $favourite = $storeFavouritePrintedDesignAction->execute($printedDesign, $user);

        return new FavouriteResource($favourite);
    }

    public function destroy(User $user, PrintedDesign $printedDesign): void
    {
        $printedDesign->favourites()->delete();
    }
}
