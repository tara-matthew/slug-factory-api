<?php

namespace App\Favourites\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FavouriteResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'favouritable_type' => $this->favouritable_type,
            'favouritable_id' => $this->favouritable_id
        ];
    }
}
