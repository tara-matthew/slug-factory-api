<?php

namespace Domain\PrintedDesigns\DataFactories;

use Domain\PrintedDesigns\DataTransferObjects\PrintedDesignData;
use Illuminate\Foundation\Http\FormRequest;

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
