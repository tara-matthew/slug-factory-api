<?php

namespace App\DataFactories;

use App\DataTransferObjects\PrintedDesignData;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class PrintedDesignDataFactory
{
    public static function fromRequest(FormRequest $request): PrintedDesignData
    {
        return new PrintedDesignData(...$request->validated());
    }

    public static function fromArray(array $data): PrintedDesignData
    {
        return new PrintedDesignData(...$data);
    }
}
