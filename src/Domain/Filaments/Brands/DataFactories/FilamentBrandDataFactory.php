<?php

namespace Domain\Filaments\Brands\DataFactories;

use Domain\Filaments\Brands\DataTransferObjects\FilamentBrandData;
use Illuminate\Foundation\Http\FormRequest;

class FilamentBrandDataFactory
{
    public static function fromRequest(FormRequest $request): FilamentBrandData
    {
        return new FilamentBrandData(...$request->validated());
    }
}
