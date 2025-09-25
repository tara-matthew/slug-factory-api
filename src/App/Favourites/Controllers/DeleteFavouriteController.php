<?php

namespace App\Favourites\Controllers;

use App\Exceptions\ItemNotFavouritedException;
use Domain\Favourites\Actions\DeleteFavouriteAction;
use Domain\Shared\Traits\IdentifiesModels;
use Domain\Users\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class DeleteFavouriteController
{
    use IdentifiesModels;

    /**
     * @throws ItemNotFavouritedException
     */
    public function __invoke(string $type, int $id, DeleteFavouriteAction $deleteFavouriteAction): Response
    {
        $model = $this->identifyModel($type, $id);

        /**
         * @var User $user
         */
        $user = Auth::user();

        if (! $model->isUserFavourite($user)) {
            throw new ItemNotFavouritedException;
        }

        $deleteFavouriteAction->handle($model, $user);

        return response()->noContent();

    }
}
