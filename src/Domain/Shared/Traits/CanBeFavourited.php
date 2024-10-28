<?php

namespace Domain\Shared\Traits;

use Domain\Users\Models\User;
use Illuminate\Support\Facades\Auth;

trait CanBeFavourited
{
    public function isUserFavourite(): bool
    {
        /**
         * @var User $user
         */
        $user = Auth::user();
        if (! $user) {
            return false;
        }

        return $this->favourites()->whereBelongsTo($user)->exists();
    }
}
