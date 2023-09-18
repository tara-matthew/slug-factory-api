<?php

namespace App\Http\Controllers;

use App\Actions\StorePrintedDesignAction;
use App\DataFactories\PrintedDesignDataFactory;
use App\Http\Requests\StorePrintedDesignRequest;
use App\Http\Requests\UpdatePrintedDesignRequest;
use App\Http\Resources\PrintedDesignResource;
use App\Models\PrintedDesign;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PrintedDesignController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return PrintedDesignResource::collection(PrintedDesign::all());
    }

    public function store(StorePrintedDesignRequest $request, StorePrintedDesignAction $storePrintedDesignAction): PrintedDesignResource
    {
        $printedDesignData = PrintedDesignDataFactory::fromRequest($request);
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
     * @param  \App\Http\Requests\UpdatePrintedDesignRequest  $request
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
