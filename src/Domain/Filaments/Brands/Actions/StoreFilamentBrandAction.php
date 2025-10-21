<?php

declare(strict_types=1);

namespace Domain\Filaments\Brands\Actions;

use Domain\Filaments\Brands\DataTransferObjects\FilamentBrandData;
use Domain\Filaments\Brands\Models\FilamentBrand;

class StoreFilamentBrandAction
{
    public function execute(FilamentBrandData $data): FilamentBrand
    {
        return FilamentBrand::create([
            'name' => $data->name,
        ]);
    }
}
