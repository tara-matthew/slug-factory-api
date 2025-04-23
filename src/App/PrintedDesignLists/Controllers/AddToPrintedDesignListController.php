<?php

namespace App\PrintedDesignLists\Controllers;

use App\PrintedDesignLists\Models\PrintedDesignList;
use App\PrintedDesignLists\Requests\AddToPrintedDesignListRequest;
use App\PrintedDesignLists\Resources\PrintedDesignListResource;
use Domain\PrintedDesigns\Events\PrintedDesignFavourited;
use Domain\PrintedDesigns\Models\PrintedDesign;
use Illuminate\Support\Facades\Auth;

class AddToPrintedDesignListController
{
    public function __invoke(AddToPrintedDesignListRequest $request, PrintedDesignList $printedDesignList): PrintedDesignListResource
    {
        $printedDesign = PrintedDesign::findOrFail($request->validated('printed_design_id'));

        $printedDesignList->printedDesigns()->attach($printedDesign);

        PrintedDesignFavourited::dispatch($printedDesign, Auth::user());

        return new PrintedDesignListResource($printedDesignList);
    }
}
