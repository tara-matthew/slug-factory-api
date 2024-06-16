<?php

namespace App\PrintedDesigns\Controllers;

use App\PrintedDesigns\Resources\PrintedDesignResource;
use Domain\PrintedDesigns\Models\PrintedDesign;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class IndexPrintedDesignsController
{
    public function __invoke(): AnonymousResourceCollection
    {
        return PrintedDesignResource::collection(
            PrintedDesign::withUserFavourites()->paginate(30)
        );
    }
}
