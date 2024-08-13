<?php

namespace App\PrintedDesigns\Resources;

use App\Images\Resources\ImageResource;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property int $id
 * @property int $user_id
 * @property string $title
 * @property string $description
 * @property int $filament_brand_id
 * @property int $filament_colour_id
 * @property int $filament_material_id
 * @property array $images
 */
class PrintedDesignResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'type' => 'PrintedDesign',
            'user_id' => $this->user_id,
            'title' => $this->title,
            'description' => $this->description,
            'images' => ImageResource::collection($this->masterImages), // whenloaded
            'filament_brand_id' => $this->filament_brand_id, // use resources?
            'filament_colour_id' => $this->filament_colour_id,
            'filament_material_id' => $this->filament_material_id,
            'is_favourite' => $this->whenLoaded('favourites', function () {
                return $this->favourites->contains('user_id', auth()->id());
            }),
            'created_at' => $this->created_at,
        ];
    }
}
