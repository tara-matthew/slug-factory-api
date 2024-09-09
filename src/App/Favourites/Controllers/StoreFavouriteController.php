<?php

namespace App\Favourites\Controllers;

use App\Exceptions\ItemAlreadyFavouritedException;
use App\Favourites\Resources\FavouriteResource;
use Domain\Favourites\Actions\StoreFavouriteAction;
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
//        dd($model);

        if ($model->isFavourite()) {
            throw new ItemAlreadyFavouritedException();
        }

        $favourite = $storeFavouriteAction->execute($model);

        return new FavouriteResource($favourite);
    }
}
