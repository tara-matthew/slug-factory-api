<?php

namespace App\Filaments\Resources;

use Domain\Filaments\Models\PrinterFilament;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin PrinterFilament
 */
class PrinterFilamentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'image_url' => $this->image_url,

        ];
    }
}
