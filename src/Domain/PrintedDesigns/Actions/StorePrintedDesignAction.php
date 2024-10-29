<?php

namespace Domain\PrintedDesigns\Actions;

use Domain\PrintedDesigns\DataTransferObjects\PrintedDesignData;
use Domain\PrintedDesigns\Models\PrintedDesign;
use Illuminate\Support\Facades\Auth;

class StorePrintedDesignAction
{
    public function execute(PrintedDesignData $printedDesignData): PrintedDesign
    {
        $printedDesign = PrintedDesign::make([
            'title' => $printedDesignData->title,
            'description' => $printedDesignData->description,
        ]);

        $printedDesign->user()->associate(Auth::user());
        $printedDesign->filamentBrand()->associate($printedDesignData->filament_brand_id);
        $printedDesign->filamentColour()->associate($printedDesignData->filament_colour_id);
        $printedDesign->filamentMaterial()->associate($printedDesignData->filament_material_id);
        $printedDesign->save();

        // TODO move into separate method/action

        foreach ($printedDesignData->images as $image) {
            $printedDesign->masterImages()->create([
                'url' => $image->url,
                'is_cover_image' => $image->is_cover_image,
            ]);
        }

        $printedDesign->loadMissing(['filamentBrand', 'filamentColour', 'filamentMaterial']);

        return $printedDesign;
    }
}
