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
            'favourited_at' => $this->created_at,
            'printed_design' => new PrintedDesignResource($this->favouritable)
        ];
    }
}
