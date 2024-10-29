<?php

namespace App\Favourites\Controllers;

use App\Exceptions\ItemNotFavouritedException;
use Domain\Favourites\Actions\DeleteFavouriteAction;
use Domain\Shared\Traits\IdentifiesModels;
use Illuminate\Http\Response;

class DeleteFavouriteController
{
    use IdentifiesModels;

    /**
     * @throws ItemNotFavouritedException
     */
    public function __invoke(string $type, string $id, DeleteFavouriteAction $deleteFavouriteAction): Response
    {
        $model = $this->identifyModel($type, $id);

        if (! $model->isUserFavourite()) {
            throw new ItemNotFavouritedException;
        }

        $deleteFavouriteAction->handle($model);

        return response()->noContent();

    }
}
