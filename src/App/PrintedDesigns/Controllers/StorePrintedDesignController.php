<?php

namespace App\PrintedDesigns\Controllers;

use App\PrintedDesigns\Requests\StorePrintedDesignRequest;
use App\PrintedDesigns\Resources\PrintedDesignResource;
use Domain\PrintedDesigns\Actions\StorePrintedDesignAction;
use Domain\PrintedDesigns\DataTransferObjects\PrintedDesignData;
use Illuminate\Support\Facades\Storage;

class StorePrintedDesignController
{
    public function __invoke(StorePrintedDesignRequest $request, StorePrintedDesignAction $storePrintedDesignAction): PrintedDesignResource
    {
        $images = $request->images;

        $printedDesignData = PrintedDesignData::from([
            'title' => $request->title,
            'description' => $request->description,
            'filament_brand_id' => $request->filament_brand_id,
            'filament_colour_id' => $request->filament_colour_id,
            'filament_material_id' => $request->filament_material_id,
            'images' => [
                [
                    'image' => $images[0]['image'],
                    'is_cover_image' => $images[0]['is_cover_image']
                ]
            ]
        ]);
        $printedDesign = $storePrintedDesignAction->execute($printedDesignData);

        return new PrintedDesignResource($printedDesign);
    }
}
