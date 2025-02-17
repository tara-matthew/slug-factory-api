<?php

namespace App\PrintedDesignSettings\Resources;

use Domain\PrintedDesignSettings\Models\PrintedDesignSetting;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin PrintedDesignSetting
 */
class PrintedDesignSettingResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'infill_percentage' => $this->infill_percentage,
            'print_speed' => $this->print_speed,
            'nozzle_size' => $this->nozzle_size,
            'uses_supports' => $this->uses_supports,
            'adhesion_type' => $this->adhesion_type,
        ];
    }
}
