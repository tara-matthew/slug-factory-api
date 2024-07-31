<?php

namespace App\Favourites\Controllers;

use App\PrintedDesigns\Resources\FavouritePrintedDesignResource;
use App\PrintedDesigns\Resources\PrintedDesignResource;
use Domain\Favourites\Models\Favourite;
use Domain\PrintedDesigns\Models\PrintedDesign;
use Domain\Users\Models\User;
use Illuminate\Support\Facades\Auth;

class IndexMyFavouritePrintedDesignsController
{
    public function __invoke()
    {
        $user = User::first();
        $favouritePrints =  $user->favourites()
            ->where('favouritable_type', PrintedDesign::class)
            ->with('favouritable')
            ->get();

        return FavouritePrintedDesignResource::collection($favouritePrints);
    }
}
