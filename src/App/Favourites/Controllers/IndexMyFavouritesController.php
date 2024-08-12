<?php

namespace App\Favourites\Controllers;

use App\Favourites\Requests\IndexFavouritesRequest;
use App\Favourites\Resources\FavouriteResource;
use Domain\Users\Models\User;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class IndexMyFavouritesController
{
    public function __invoke(IndexFavouritesRequest $request): AnonymousResourceCollection
    {
        $user = User::find(1);
        $favourites = $user->favourites()
            ->where('favouritable_type', $request->validated('type'))
            ->with('favouritable')
            ->get();

        return FavouriteResource::collection($favourites);
    }
}
