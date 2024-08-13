<?php

namespace App\Filaments\Brands\Controllers;

use App\Filaments\Brands\Resources\FilamentBrandResource;
use Domain\Filaments\Brands\Models\FilamentBrand;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class IndexFilamentBrandsController
{
    public function __invoke(): AnonymousResourceCollection
    {
        return FilamentBrandResource::collection(
            FilamentBrand::query()->paginate()
        );
    }
}
