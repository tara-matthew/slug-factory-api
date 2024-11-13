<?php

namespace App\PrintedDesigns\Resources;

use App\Filaments\Brands\Resources\FilamentBrandResource;
use App\Filaments\Colours\Resources\FilamentColourResource;
use App\Filaments\Materials\Resources\FilamentMaterialResource;
use App\Images\Resources\PrintedDesignImageResource;
use App\PrintedDesignSettings\Resources\PrintedDesignSettingResource;
use App\Users\Resources\UserResource;
use Domain\PrintedDesigns\Models\PrintedDesign;
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
            'user' => new UserResource($this->user), // TODO change to a reduced user resource which hides private fields, or use conditional attributes. whenLoaded
            'title' => $this->title,
            'description' => $this->description,
            'images' => PrintedDesignImageResource::collection($this->masterImages), // whenloaded
            'filament_brand' => new FilamentBrandResource($this->whenLoaded('filamentBrand')),
            'filament_colour' => new FilamentColourResource($this->whenLoaded('filamentColour')),
            'filament_material' => new FilamentMaterialResource($this->whenLoaded('filamentMaterial')),
            'is_favourite' => $this->whenLoaded('favourites', function () {
                return $this->favourites->contains('user_id', auth()->id());
            }),
            'favourited_count' => $this->favourites->count(), // TODO $this->whenCounted('favourites'),
            'settings' => new PrintedDesignSettingResource($this->whenLoaded('printedDesignSetting')),
            'created_at' => $this->created_at
        ];
    }
}
