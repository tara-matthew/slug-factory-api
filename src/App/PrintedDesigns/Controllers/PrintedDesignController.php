<?php

namespace App\PrintedDesigns\Controllers;

use App\PrintedDesigns\Requests\StorePrintedDesignRequest;
use App\PrintedDesigns\Requests\UpdatePrintedDesignRequest;
use Domain\PrintedDesigns\Actions\StorePrintedDesignAction;
use Domain\PrintedDesigns\DataTransferObjects\PrintedDesignData;
use Domain\PrintedDesigns\Models\PrintedDesign;
use Spatie\LaravelData\DataCollection;
use Support\Controllers\Controller;

class PrintedDesignController extends Controller
{
    public function index(): DataCollection
    {
        return PrintedDesignData::collection(PrintedDesign::withUserFavourites());
    }

    public function store(StorePrintedDesignRequest $request, StorePrintedDesignAction $storePrintedDesignAction): PrintedDesignData
    {
        $printedDesignData = PrintedDesignData::from($request->validated());
        $printedDesign = $storePrintedDesignAction->execute($printedDesignData);

        return PrintedDesignData::from($printedDesign);
    }

     public function show(PrintedDesign $printedDesign): PrintedDesignData
     {
         return PrintedDesignData::from($printedDesign);
     }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\PrintedDesigns\Requests\UpdatePrintedDesignRequest  $request
     * @param  PrintedDesign  $printedDesign
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePrintedDesignRequest $request, PrintedDesign $printedDesign)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  PrintedDesign  $printedDesign
     * @return \Illuminate\Http\Response
     */
    public function destroy(PrintedDesign $printedDesign)
    {
        //
    }
}
