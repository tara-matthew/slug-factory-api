<?php

namespace App\PrintedDesignLists\Controllers;

use App\PrintedDesignLists\Models\PrintedDesignList;
use App\PrintedDesignLists\Requests\AddToPrintedDesignListRequest;
use App\PrintedDesignLists\Resources\PrintedDesignListResource;
use Domain\PrintedDesigns\Models\PrintedDesign;

class AddToPrintedDesignListController
{
    public function __invoke(AddToPrintedDesignListRequest $request, PrintedDesignList $printedDesignList)
    {
        $validated = $request->validated();

        $printedDesign = PrintedDesign::find($validated['printed_design_id']);

        $printedDesignList->printedDesigns()->attach($printedDesign);

        return new PrintedDesignListResource($printedDesignList);
    }
}
