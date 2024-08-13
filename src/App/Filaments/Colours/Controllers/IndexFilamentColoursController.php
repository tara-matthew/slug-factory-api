<?php

namespace App\Filaments\Colours\Controllers;

use App\Filaments\Colours\Resources\FilamentColourResource;
use Domain\Filaments\Colours\Models\FilamentColour;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class IndexFilamentColoursController
{
    public function __invoke(): AnonymousResourceCollection
    {
        return FilamentColourResource::collection(FilamentColour::query()->paginate());
    }
}
