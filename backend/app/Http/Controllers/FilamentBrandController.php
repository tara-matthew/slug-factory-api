<?php

namespace App\Http\Controllers;

use App\Actions\StoreFilamentBrandAction;
use App\DataFactories\FilamentBrandDataFactory;
use App\Http\Requests\StoreFilamentBrandRequest;
use App\Http\Resources\FilamentBrandResource;
use App\Models\FilamentBrand;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

// TODO require user auth
class FilamentBrandController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return FilamentBrandResource::collection(FilamentBrand::all());
    }

    public function store(StoreFilamentBrandRequest $request): FilamentBrandResource
    {
        $filamentBrandData = FilamentBrandDataFactory::fromRequest($request);
        $filamentBrand = (new StoreFilamentBrandAction())->execute($filamentBrandData);

        return new FilamentBrandResource($filamentBrand);
    }

    public function show(FilamentBrand $filamentBrand): FilamentBrandResource
    {
        return new FilamentBrandResource($filamentBrand);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
