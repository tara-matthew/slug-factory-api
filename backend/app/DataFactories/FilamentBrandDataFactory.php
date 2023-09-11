<?php

namespace App\DataFactories;

use App\DataTransferObjects\FilamentBrandData;
use Illuminate\Foundation\Http\FormRequest;

class FilamentBrandDataFactory
{
    public static function fromRequest(FormRequest $request): FilamentBrandData
    {
        return new FilamentBrandData(...$request->validated());
    }
}
