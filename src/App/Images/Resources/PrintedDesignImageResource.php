<?php

namespace App\Images\Resources;

use Domain\Images\Models\PrintedDesignImage;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin PrintedDesignImage
 * @property string $blurhash
 * @property bool $is_cover_image
 */
class PrintedDesignImageResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'printed_design_id' => $this->printed_design_id,
            'user_id' => $this->user_id,
            'url' => $this->url,
            'blurhash' => $this->blurhash,
            'is_cover_image' => (bool) $this->is_cover_image,
        ];
    }
}
