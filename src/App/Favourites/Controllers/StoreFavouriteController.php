<?php

namespace App\Favourites\Controllers;

use App\Exceptions\ItemAlreadyFavouritedException;
use App\Favourites\Resources\FavouriteResource;
use Domain\Favourites\Actions\StoreFavouriteAction;
use Domain\Shared\Traits\IdentifiesModels;
use Domain\Users\Models\User;
use Illuminate\Support\Facades\Auth;

class StoreFavouriteController // could have toggle favourite controller instead
{
    use IdentifiesModels;

    /**
     * @throws ItemAlreadyFavouritedException
     */
    public function __invoke(string $type, int $id, StoreFavouriteAction $storeFavouriteAction): FavouriteResource
    {
        $model = $this->identifyModel($type, $id);

        /**
         * @var User $user
         */
        $user = Auth::user();

        if ($model->isUserFavourite($user)) {
            throw new ItemAlreadyFavouritedException;
        }

        $favourite = $storeFavouriteAction->execute($model, $user);

        return new FavouriteResource($favourite);
    }
}
