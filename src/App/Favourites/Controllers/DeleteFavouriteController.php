<?php

namespace App\Favourites\Controllers;

use Domain\Shared\Traits\IdentifiesModels;
use Domain\Users\Models\User;

class DeleteFavouriteController
{
    use IdentifiesModels;

    public function __invoke(string $type, string $id)
    {
        $user = User::find(1);
        $model = $this->identifyModel($type, $id);
        $model->favourites()->where('user_id', $user->id)->delete();

        return response()->noContent();

    }
}
