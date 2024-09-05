<?php

namespace Domain\Favourites\Actions;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class DeleteFavouriteAction
{
    public function handle(Model $model): void
    {
        $user = Auth::user();

        $model->favourites()->whereBelongsTo($user)->delete();
    }
}
