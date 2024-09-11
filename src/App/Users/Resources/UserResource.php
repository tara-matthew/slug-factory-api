<?php

namespace App\Users\Resources;

use App\Http\Resources\CountryResource;
use App\Http\Resources\UserProfileResource;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'country' => new CountryResource($this->whenLoaded('country')),
            'name' => $this->name,
            'username' => $this->username,
            'email' => $this->email,
            'avatar_url' => $this->avatar_url,
            'profile' => new UserProfileResource($this->whenLoaded('userProfile')),
        ];
    }
}
