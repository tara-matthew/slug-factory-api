<?php

namespace App\Filaments\Brands\Controllers;

use App\Filaments\Brands\Resources\FilamentBrandResource;
use Domain\Filaments\Brands\Models\FilamentBrand;

class ShowFilamentBrandController
{
    public function __invoke(FilamentBrand $filamentBrand): FilamentBrandResource
    {
        return new FilamentBrandResource($filamentBrand);
    }
}
