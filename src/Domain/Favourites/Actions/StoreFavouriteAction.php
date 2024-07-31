<?php

namespace Domain\Favourites\Actions;

use App\Exceptions\ItemAlreadyFavouritedException;
use Domain\PrintedDesigns\Models\PrintedDesign;
use Domain\Users\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class StoreFavouriteAction
{
    /**
     * @throws ItemAlreadyFavouritedException
     */
    public function execute(Model $model): Model
    {
        $user = User::find(1);
        if ($model->isFavourited()) {
            throw new ItemAlreadyFavouritedException();
        }

        $favourite = $model->favourites()->make();
        $favourite->user()->associate($user);
        $favourite->save();

        return $favourite;
    }
}
