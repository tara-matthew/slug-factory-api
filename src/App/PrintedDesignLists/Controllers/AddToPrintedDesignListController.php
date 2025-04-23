<?php

namespace App\PrintedDesignLists\Controllers;

use App\PrintedDesignLists\Models\PrintedDesignList;
use App\PrintedDesignLists\Requests\AddToPrintedDesignListRequest;
use App\PrintedDesignLists\Resources\PrintedDesignListResource;
use Domain\PrintedDesigns\Models\PrintedDesign;

class AddToPrintedDesignListController
{
    public function __invoke(AddToPrintedDesignListRequest $request, PrintedDesignList $printedDesignList): PrintedDesignListResource
    {
        $printedDesign = PrintedDesign::findOrFail($request->validated('printed_design_id'));

        $printedDesignList->printedDesigns()->attach($printedDesign);

        // TODO dispatch an event when a printed design is added to a list

        return new PrintedDesignListResource($printedDesignList);
    }
}
