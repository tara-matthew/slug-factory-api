<?php

namespace App\PrintedDesigns\Controllers;

use App\Exceptions\ItemAlreadyFavouritedException;
use App\Favourites\Resources\FavouriteResource;
use Domain\Favourites\Actions\StoreFavouriteAction;
use Domain\Favourites\Models\Favourite;
use Domain\PrintedDesigns\Models\PrintedDesign;
use Domain\Shared\Traits\IdentifiesModels;
use Domain\Users\Models\User;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StoreFavouriteController // could have toggle favourite controller instead
{
    use IdentifiesModels;

    /**
     * @throws ItemAlreadyFavouritedException
     */
    public function __invoke(string $type, int $id, StoreFavouriteAction $storeFavouriteAction)
    {
        $model = $this->identifyModel($type, $id);

        $favourite = $storeFavouriteAction->execute($model);

        return new FavouriteResource($favourite);
}
}
