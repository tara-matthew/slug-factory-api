<?php

namespace Domain\Favourites\Actions;

use App\Exceptions\ItemAlreadyFavouritedException;
use Domain\Filaments\Materials\Models\FilamentMaterial;
use Domain\PrintedDesigns\Events\PrintedDesignFavourited;
use Domain\PrintedDesigns\Models\PrintedDesign;
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

        if ($model instanceof PrintedDesign) {
            PrintedDesignFavourited::dispatch($model, $model->user);

        }

        return $favourite;
    }
}
