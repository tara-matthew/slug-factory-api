<?php

namespace Domain\Favourites\Actions;

use App\Exceptions\ItemAlreadyFavouritedException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class StoreFavouriteAction
{
    /**
     * @throws ItemAlreadyFavouritedException
     */
    public function execute(Model $model): Model
    {
        $user = Auth::user();

        $favourite = $model->favourites()->make();
        $favourite->user()->associate($user);
        $favourite->save();

        return $favourite;
    }
}
