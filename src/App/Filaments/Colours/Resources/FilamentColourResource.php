<?php

namespace App\Filaments\Colours\Resources;

use Domain\Filaments\Colours\Models\FilamentColour;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin FilamentColour
 */
class FilamentColourResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
