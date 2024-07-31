<?php

namespace App\Favourites\Controllers;

use App\Favourites\Requests\IndexFavouritesRequest;
use App\Favourites\Resources\FavouriteResource;
use App\PrintedDesigns\Resources\FavouritePrintedDesignResource;
use App\PrintedDesigns\Resources\PrintedDesignResource;
use Domain\Favourites\Models\Favourite;
use Domain\PrintedDesigns\Models\PrintedDesign;
use Domain\Users\Models\User;
use Illuminate\Support\Facades\Auth;

class IndexMyFavouritesController
{
    public function __invoke(IndexFavouritesRequest $request)
    {
        $user = User::find(1);
        $favourites =  $user->favourites()
            ->where('favouritable_type', $request->validated('type'))
            ->with('favouritable')
            ->get();

        return FavouriteResource::collection($favourites);
    }
}
