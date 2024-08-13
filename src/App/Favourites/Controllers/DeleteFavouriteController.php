<?php

namespace App\Favourites\Controllers;

use Domain\Shared\Traits\IdentifiesModels;
use Domain\Users\Models\User;
use Illuminate\Http\Response;

class DeleteFavouriteController
{
    use IdentifiesModels;

    public function __invoke(string $type, string $id): Response
    {
        $user = User::find(1);
        $model = $this->identifyModel($type, $id);

        if (! $model->isFavourite()) {
            // throw an exception
        }
        $model->favourites()->where('user_id', $user->id)->delete();

        return response()->noContent();

    }
}
