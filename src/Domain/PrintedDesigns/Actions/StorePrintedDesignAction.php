<?php

namespace Domain\PrintedDesigns\Actions;

use Domain\PrintedDesigns\DataTransferObjects\PrintedDesignData;
use Domain\PrintedDesigns\Models\PrintedDesign;

class StorePrintedDesignAction
{
    public function execute(PrintedDesignData $printedDesignData): PrintedDesign
    {
        $printedDesign = PrintedDesign::make([
            'title' => $printedDesignData->title,
            'description' => $printedDesignData->description,
        ]);

        $printedDesign->user()->associate($printedDesignData->user_id);
        $printedDesign->filamentBrand()->associate($printedDesignData->filament_brand_id);
        $printedDesign->filamentColour()->associate($printedDesignData->filament_colour_id);
        $printedDesign->save();

        foreach ($printedDesignData->images as $image) {
            $printedDesign->images()->create([
                'url' => $image->url,
                'is_cover_image' => $image->is_cover_image,
            ]);
        }

        return $printedDesign;
    }
}
