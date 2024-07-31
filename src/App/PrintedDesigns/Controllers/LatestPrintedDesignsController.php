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
            PrintedDesign::query()
                ->latest()
                ->take(10)
                ->get()
        );
    }
}
