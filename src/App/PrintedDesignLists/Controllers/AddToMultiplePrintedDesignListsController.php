<?php

namespace App\PrintedDesignLists\Controllers;

use App\PrintedDesignLists\Models\PrintedDesignList;
use App\PrintedDesignLists\Requests\AddToPrintedDesignListsRequest;
use App\PrintedDesigns\Resources\PrintedDesignResource;
use Domain\PrintedDesigns\Models\PrintedDesign;

class AddToMultiplePrintedDesignListsController
{
    public function __invoke(AddToPrintedDesignListsRequest $request, PrintedDesign $printedDesign)
    {
        foreach ($request->validated('printed_design_list_ids') as $printedDesignListId) {
            $printedDesignList = PrintedDesignList::findOrFail($printedDesignListId);

            $printedDesign->printedDesignLists()->attach($printedDesignList);
        }

        return new PrintedDesignResource($printedDesign);
    }
}
