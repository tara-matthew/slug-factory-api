<?php

namespace App\Images\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @properrt int $id
 *
 * @property int | null $printed_design_id
 * @property int | null $user_id
 * @property string $url
 * @property bool $is_cover_image
 */
class ImageResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'printed_design_id' => $this->printed_design_id,
            'user_id' => $this->user_id,
            'url' => $this->url,
            'is_cover_image' => (bool) $this->is_cover_image,
        ];
    }
}
