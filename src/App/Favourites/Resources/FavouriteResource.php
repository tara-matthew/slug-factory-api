<?php

namespace App\Favourites\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FavouriteResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'type' => 'FavouritePrintedDesign',
            'favourited_at' => $this->created_at,
            'resource' => $this->favouritable->toResource()
        ];
    }
}
