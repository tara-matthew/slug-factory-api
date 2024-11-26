<?php

namespace App\Auth\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property string $plainTextToken
 */
class AccessTokenResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'token' => $this->plainTextToken,
        ];
    }
}
