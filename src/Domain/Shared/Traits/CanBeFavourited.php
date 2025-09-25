<?php

namespace Domain\Shared\Traits;

use Domain\Users\Models\User;

trait CanBeFavourited
{
    public function isUserFavourite(User $user): bool
    {
        return $this->favourites()->whereBelongsTo($user)->exists();
    }
}
