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
        $availableLists = Auth::user()->printedDesignLists()
            ->withCount('printedDesigns')
            ->with(['printedDesigns' => function ($query) use ($printedDesign) {
                $query->where('printed_design_id', $printedDesign->id);
            }])
            ->where('title', '!=', 'Recently Viewed')
            ->get();

        return PrintedDesignListResource::collection($availableLists);
    }
}
