<?php

namespace App\PrintedDesignLists\Resources;

use App\PrintedDesignLists\Models\PrintedDesignList;
use App\Users\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin PrintedDesignList
 */
class PrintedDesignListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'user' => new UserResource($this->whenLoaded('user')),
        ];
    }
}
