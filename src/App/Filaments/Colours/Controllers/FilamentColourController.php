<?php

namespace App\Filaments\Colours\Controllers;

use App\Filaments\Colours\Resources\FilamentColourResource;
use Domain\Filaments\Colours\Models\FilamentColour;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Support\Controllers\Controller;

class FilamentColourController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return FilamentColourResource::collection(FilamentColour::all());

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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \Domain\Favourites\FilamentColour  $filamentColour
     * @return \Illuminate\Http\Response
     */
    public function show(FilamentColour $filamentColour)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Domain\Favourites\FilamentColour  $filamentColour
     * @return \Illuminate\Http\Response
     */
    public function edit(FilamentColour $filamentColour)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Domain\Favourites\FilamentColour  $filamentColour
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FilamentColour $filamentColour)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Domain\Favourites\FilamentColour  $filamentColour
     * @return \Illuminate\Http\Response
     */
    public function destroy(FilamentColour $filamentColour)
    {
        //
    }
}
