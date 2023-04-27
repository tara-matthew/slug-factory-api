<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePrintedDesignRequest;
use App\Http\Requests\UpdatePrintedDesignRequest;
use App\Http\Resources\PrintedDesignResource;
use App\Models\PrintedDesign;
use JetBrains\PhpStorm\Pure;

class PrintedDesignController extends Controller
{
    public function index(): PrintedDesignResource
    {
        return new PrintedDesignResource(PrintedDesign::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function store(StorePrintedDesignRequest $request): PrintedDesignResource
    {
        $printedDesign = PrintedDesign::create(
            $request->validated()
        );
        foreach ($request->safe()->only(['images'])['images'] as $image) {
            $printedDesign->images()->create([
                'url' => $image['url']
            ]);
        }

        return new PrintedDesignResource($printedDesign);
    }

    #[Pure] public function show(PrintedDesign $printedDesign): PrintedDesignResource
    {
        return new PrintedDesignResource($printedDesign);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param PrintedDesign $printedDesign
     * @return \Illuminate\Http\Response
     */
    public function edit(PrintedDesign $printedDesign)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePrintedDesignRequest  $request
     * @param PrintedDesign $printedDesign
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePrintedDesignRequest $request, PrintedDesign $printedDesign)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param PrintedDesign $printedDesign
     * @return \Illuminate\Http\Response
     */
    public function destroy(PrintedDesign $printedDesign)
    {
        //
    }
}
