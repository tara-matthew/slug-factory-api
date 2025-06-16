<?php

namespace Domain\Shared\Traits;

use Domain\Users\Models\User;
use Illuminate\Support\Facades\Auth;

trait CanBeFavourited
{
    public function isUserFavourite(): bool
    {
        /**
         * @var User|null $user
         */
        $user = Auth::user();

        return $this->favourites()->whereBelongsTo($user)->exists();
    }
}
