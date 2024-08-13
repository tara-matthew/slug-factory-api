<?php

namespace Domain\Favourites\Actions;

use App\Exceptions\ItemAlreadyFavouritedException;
use Domain\Users\Models\User;
use Illuminate\Database\Eloquent\Model;

class StoreFavouriteAction
{
    /**
     * @throws ItemAlreadyFavouritedException
     */
    public function execute(Model $model): Model
    {
        $user = User::find(1);
        if ($model->isFavourite()) {
            throw new ItemAlreadyFavouritedException();
        }

        $favourite = $model->favourites()->make();
        $favourite->user()->associate($user);
        $favourite->save();

        return $favourite;
    }
}
