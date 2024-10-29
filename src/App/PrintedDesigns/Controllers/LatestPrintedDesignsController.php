<?php

namespace App\PrintedDesigns\Controllers;

use App\PrintedDesigns\Resources\PrintedDesignResource;
use Domain\PrintedDesigns\Models\PrintedDesign;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class LatestPrintedDesignsController
{
    public function __invoke(): AnonymousResourceCollection
    {
        return PrintedDesignResource::collection(
            PrintedDesign::with(['favourites', 'filamentBrand', 'filamentColour', 'filamentMaterial'])
                ->latest()
                ->take(10) // TODO put into a const or config & environment variable
                ->get()
        );
    }
}
