<?php

namespace App\Filaments\Brands\Controllers;

use App\Filaments\Brands\Requests\StoreFilamentBrandRequest;
use App\Filaments\Brands\Resources\FilamentBrandResource;
use Domain\Filaments\Brands\Actions\StoreFilamentBrandAction;
use Domain\Filaments\Brands\DataTransferObjects\FilamentBrandData;

class StoreFilamentBrandController
{
    public function __invoke(StoreFilamentBrandRequest $request): FilamentBrandResource
    {
        $filamentBrandData = FilamentBrandData::from($request->validated());
        $filamentBrand = (new StoreFilamentBrandAction())->execute($filamentBrandData);

        return new FilamentBrandResource($filamentBrand);
    }
}
