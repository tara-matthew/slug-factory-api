<?php

namespace App\Actions;

use App\Models\Favourite;
use App\Models\PrintedDesign;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class StoreFavouritePrintedDesignAction
{
    public function execute(PrintedDesign $printedDesign, User $user): Model
    {
        return $printedDesign->favourites()->create(['user_id' => $user->id]);
    }
}
