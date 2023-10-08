<?php

namespace App\Favourites\Controllers;

use App\Favourites\Resources\FavouriteResource;
use App\PrintedDesigns\Resources\PrintedDesignResource;
use Domain\Favourites\Actions\StoreFavouritePrintedDesignAction;
use Domain\Favourites\Models\Favourite;
use Domain\PrintedDesigns\Models\PrintedDesign;
use Domain\Users\Models\User;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Support\Controllers\Controller;

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
