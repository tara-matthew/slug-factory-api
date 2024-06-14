<?php

namespace Domain\PrintedDesigns\Actions;

use Domain\PrintedDesigns\DataTransferObjects\PrintedDesignData;
use Domain\PrintedDesigns\Models\PrintedDesign;

class StorePrintedDesignAction
{
    public function execute(PrintedDesignData $printedDesignData): PrintedDesign
    {
        $printedDesign = PrintedDesign::create([
            'title' => $printedDesignData->title,
            'description' => $printedDesignData->description,
            'user_id' => $printedDesignData->user_id,
            'filament_brand_id' => $printedDesignData->filament_brand_id,
            'filament_colour_id' => $printedDesignData->filament_colour_id,
        ]);
        foreach ($printedDesignData->images as $image) {
            $printedDesign->images()->create([
                'url' => $image->url,
                'is_cover_image' => $image->is_cover_image,
            ]);
        }

        return $printedDesign;
    }
}
