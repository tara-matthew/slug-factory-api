<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePrintedDesignRequest;
use App\Http\Requests\UpdatePrintedDesignRequest;
use App\Http\Resources\PrintedDesignResource;
use App\Models\PrintedDesign;
use Illuminate\Http\JsonResponse;

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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePrintedDesignRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePrintedDesignRequest $request)
    {
        //
    }

    public function show(PrintedDesign $printedDesign): PrintedDesignResource
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
