<?php

namespace App\Filaments\Brands\Controllers;

use App\Filaments\Brands\Requests\StoreFilamentBrandRequest;
use App\Filaments\Brands\Resources\FilamentBrandResource;
use Domain\Filaments\Brands\Actions\StoreFilamentBrandAction;
use Domain\Filaments\Brands\DataFactories\FilamentBrandDataFactory;
use Domain\Filaments\Brands\DataTransferObjects\FilamentBrandData;
use Domain\Filaments\Brands\Models\FilamentBrand;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Support\Controllers\Controller;

class FilamentBrandController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return FilamentBrandResource::collection(FilamentBrand::all());
    }

    public function store(StoreFilamentBrandRequest $request): FilamentBrandResource
    {
        $filamentBrandData = FilamentBrandData::from($request->validated());
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
