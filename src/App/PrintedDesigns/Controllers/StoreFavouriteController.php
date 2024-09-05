<?php

namespace App\PrintedDesigns\Controllers;

use App\Exceptions\ItemAlreadyFavouritedException;
use App\Favourites\Resources\FavouriteResource;
use Domain\Favourites\Actions\StoreFavouriteAction;
use Domain\Favourites\Models\Favourite;
use Domain\Shared\Traits\IdentifiesModels;

class StoreFavouriteController // could have toggle favourite controller instead
{
    use IdentifiesModels;

    /**
     * @throws ItemAlreadyFavouritedException
     */
    public function __invoke(string $type, int $id, StoreFavouriteAction $storeFavouriteAction): FavouriteResource
    {
        $model = $this->identifyModel($type, $id);

        if ($model->isFavourite()) {
            throw new ItemAlreadyFavouritedException();
        }

        $favourite = $storeFavouriteAction->execute($model);

        return new FavouriteResource($favourite);
    }
}
