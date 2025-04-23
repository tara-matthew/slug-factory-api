<?php

namespace App\PrintedDesignLists\Controllers;

use App\PrintedDesignLists\Resources\PrintedDesignListResource;
use Domain\PrintedDesigns\Models\PrintedDesign;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;

class ShowAvailablePrintedDesignListsController
{
    public function __invoke(PrintedDesign $printedDesign): AnonymousResourceCollection
    {
        $userLists = Auth::user()->printedDesignLists;
        $availableLists = $userLists->filter(function ($list) use ($printedDesign) {
            return $list->title !== 'Recently Viewed' && ! $list->printedDesigns->contains($printedDesign);
        });

        return PrintedDesignListResource::collection($availableLists);
    }
}
