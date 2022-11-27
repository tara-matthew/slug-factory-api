<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePrintedDesignRequest;
use App\Http\Requests\UpdatePrintedDesignRequest;
use App\Models\PrintedDesign;

class PrintedDesignController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PrintedDesign  $printedDesign
     * @return \Illuminate\Http\Response
     */
    public function show(PrintedDesign $printedDesign)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PrintedDesign  $printedDesign
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
     * @param  \App\Models\PrintedDesign  $printedDesign
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePrintedDesignRequest $request, PrintedDesign $printedDesign)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PrintedDesign  $printedDesign
     * @return \Illuminate\Http\Response
     */
    public function destroy(PrintedDesign $printedDesign)
    {
        //
    }
}