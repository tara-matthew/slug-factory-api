<?php

namespace App\PrintedDesigns\Controllers;

use App\PrintedDesigns\Requests\StorePrintedDesignRequest;
use App\PrintedDesigns\Requests\UpdatePrintedDesignRequest;
use App\PrintedDesigns\Resources\PrintedDesignResource;
use Domain\PrintedDesigns\Actions\StorePrintedDesignAction;
use Domain\PrintedDesigns\DataTransferObjects\PrintedDesignData;
use Domain\PrintedDesigns\Models\PrintedDesign;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Spatie\LaravelData\DataCollection;
use Support\Controllers\Controller;

class PrintedDesignController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return PrintedDesignResource::collection(PrintedDesign::withUserFavourites());
    }

    public function store(StorePrintedDesignRequest $request, StorePrintedDesignAction $storePrintedDesignAction): PrintedDesignResource
    {
        $printedDesignData = PrintedDesignData::from($request->validated());
        $printedDesign = $storePrintedDesignAction->execute($printedDesignData);

        return new PrintedDesignResource($printedDesign);
    }

     public function show(PrintedDesign $printedDesign): PrintedDesignResource
     {
         return new PrintedDesignResource($printedDesign);
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
