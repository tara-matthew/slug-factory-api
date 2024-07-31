<?php

namespace Domain\Favourites\Actions;

use Domain\PrintedDesigns\Models\PrintedDesign;
use Domain\Users\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class StoreFavouritePrintedDesignAction
{
    public function execute(PrintedDesign $printedDesign): Model
    {
        $favourite = $printedDesign->favourites()->make();
        $favourite->user()->associate(Auth::user());
        $favourite->save();
        return $favourite;
//        dd($favourite);
//        $printedDesign->favourites()->associate($favourite);
//        dd($favourite);
    }
}
