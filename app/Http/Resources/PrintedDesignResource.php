<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property int $id
 * @property int $user_id
 * @property string $title
 * @property string $description
 * @property int $filament_brand_id
 * @property int $filament_colour_id
 * @property array $images
 */
class PrintedDesignResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'title' => $this->title,
            'description' => $this->description,
            'images' => ImageResource::collection($this->images),
            'filament_brand_id' => $this->filament_brand_id,
            'filament_colour_id' => $this->filament_colour_id,
            'is_favourite' => (bool) $this->favourites->filter(function ($favourite) {
                return $favourite->user_id === auth()->id();
            })->first() // exists?
            // TODO add created and updated_at
        ];
    }
}
