<?php

namespace App\Favourites\Controllers;

use App\Favourites\Requests\IndexFavouritesRequest;
use App\Favourites\Resources\FavouriteResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;

class IndexMyFavouritesController
{
    public function __invoke(IndexFavouritesRequest $request): AnonymousResourceCollection
    {
        $user = Auth::user();

        $favourites = $user->favourites()
            ->where('favouritable_type', $request->validated('type'))
            ->with('favouritable')
            ->get();

        return FavouriteResource::collection($favourites);
    }
}
