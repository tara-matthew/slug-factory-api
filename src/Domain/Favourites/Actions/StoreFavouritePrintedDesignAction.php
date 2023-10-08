<?php

namespace Domain\Favourites\Actions;

use Domain\PrintedDesigns\Models\PrintedDesign;
use Domain\Users\Models\User;
use Illuminate\Database\Eloquent\Model;

class StoreFavouritePrintedDesignAction
{
    public function execute(PrintedDesign $printedDesign, User $user): Model
    {
        return $printedDesign->favourites()->create(['user_id' => $user->id]);
    }
}
