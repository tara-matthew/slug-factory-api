<?php

namespace App\PrintedDesignLists\Controllers;

use App\PrintedDesignLists\Models\PrintedDesignList;
use App\PrintedDesignLists\Requests\AddToPrintedDesignListsRequest;
use App\PrintedDesigns\Resources\PrintedDesignResource;
use Domain\PrintedDesigns\Models\PrintedDesign;

class UpdatePrintedDesignPrintedDesignListsController
{
    // TODO rework to allow to remove
    // TODO use a transaction
    public function __invoke(AddToPrintedDesignListsRequest $request, PrintedDesign $printedDesign)
    {
        $addIds = $request->validated('printed_design_list_add_ids') ?? [];
        $removeIds = $request->validated('printed_design_list_remove_ids') ?? [];

        if ($addIds) {
            $printedDesignListsToAdd = PrintedDesignList::whereIn('id', $addIds)->get();

            $printedDesign->printedDesignLists()->attach($printedDesignListsToAdd);
        }

        if ($removeIds) {
            $printedDesignListsToRemove = PrintedDesignList::whereIn('id', $removeIds)->get();

            $printedDesign->printedDesignLists()->detach($printedDesignListsToRemove);
        }

        return new PrintedDesignResource($printedDesign);
    }
}
