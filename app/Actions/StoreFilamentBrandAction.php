<?php

namespace App\Actions;

use App\DataTransferObjects\FilamentBrandData;
use App\Models\FilamentBrand;

class StoreFilamentBrandAction
{
    public function execute(FilamentBrandData $data): FilamentBrand
    {
        return FilamentBrand::create([
            'name' => $data->name,
        ]);
    }
}
