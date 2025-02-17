<?php

namespace App\Filaments\Brands\Resources;

use Domain\Filaments\Brands\Models\FilamentBrand;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin FilamentBrand
 */
class FilamentBrandResource extends JsonResource
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
