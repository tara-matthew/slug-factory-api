<?php

namespace Domain\PrintedDesigns\Actions;

use Domain\PrintedDesigns\DataTransferObjects\UpdatePrintedDesignData;
use Domain\PrintedDesigns\Models\PrintedDesign;

class UpdatePrintedDesignAssociatedDetails
{
    public function execute(PrintedDesign $printedDesign, UpdatePrintedDesignData $printedDesignData)
    {
        $associations = [
            'filamentBrand' => $printedDesignData->filament_brand_id,
            'filamentColour' => $printedDesignData->filament_colour_id,
            'filamentMaterial' => $printedDesignData->filament_material_id,
        ];

        foreach ($associations as $relation => $id) {
            if (! is_null($id)) {
                $printedDesign->$relation()->associate($id);
            }
        }

        $printedDesign->save();

        return $printedDesign;

    }
}
