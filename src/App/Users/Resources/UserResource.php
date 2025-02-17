<?php

namespace App\Users\Resources;

use App\Http\Resources\CountryResource;
use App\Http\Resources\UserProfileResource;
use Domain\Users\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin User
 */
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
            'avatar_url' => $this->avatar_url, // TODO this can go in the user profile
            'favourites_count' => $this->whenCounted('favourites'),
            'prints_count' => $this->whenCounted('printedDesigns'), // TODO change to upload_count
            //            'bio' => $this->userProfile->bio,
            //            'set_public_at' => $this->userProfile->set_public_at,
            'profile' => new UserProfileResource($this->whenLoaded('userProfile')),
        ];
    }
}
