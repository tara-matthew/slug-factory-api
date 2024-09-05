<?php

namespace App\Favourites\Controllers;

use App\Exceptions\ItemNotFavouritedException;
use Domain\Shared\Traits\IdentifiesModels;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class DeleteFavouriteController
{
    use IdentifiesModels;

    /**
     * @throws ItemNotFavouritedException
     */
    public function __invoke(string $type, string $id): Response
    {
        $user = Auth::user();
        $model = $this->identifyModel($type, $id);

        if (! $model->isFavourite()) {
            throw new ItemNotFavouritedException();
        }
        $model->favourites()->where('user_id', $user->id)->delete(); // wherebelongsto?

        return response()->noContent();

    }
}
