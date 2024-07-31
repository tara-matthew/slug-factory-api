<?php

namespace App\PrintedDesigns\Resources;

use App\Images\Resources\ImageResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FavouritePrintedDesignResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'type' => 'FavouritePrintedDesign',
            'user_id' => $this->user_id,
            'title' => $this->favouritable->title,
            'description' => $this->favouritable->description,
            'images' => ImageResource::collection($this->favouritable->images), // whenloaded
            'filament_brand_id' => $this->favouritable->filament_brand_id,
            'filament_colour_id' => $this->favouritable->filament_colour_id,
            'favourited_at' => $this->favouritable->created_at
        ];
    }
}
