<?php

namespace App\PrintedDesigns\Controllers;

use App\PrintedDesigns\Requests\StorePrintedDesignRequest;
use App\PrintedDesigns\Resources\PrintedDesignResource;
use Domain\PrintedDesigns\Actions\StorePrintedDesignAction;
use Domain\PrintedDesigns\DataTransferObjects\PrintedDesignData;

class StorePrintedDesignController
{
    public function __invoke(StorePrintedDesignRequest $request, StorePrintedDesignAction $storePrintedDesignAction): PrintedDesignResource
    {
        $images = collect($request->images)->map(function ($image) {
            return [
                'image' => $image['image'],
                'is_cover_image' => $image['is_cover_image'],
            ];
        });

        $printedDesignData = PrintedDesignData::from([
            'title' => $request->title,
            'description' => $request->description,
            'filament_brand_id' => $request->filament_brand_id,
            'filament_colour_id' => $request->filament_colour_id,
            'filament_material_id' => $request->filament_material_id,
            'images' => $images,
        ]);
        $printedDesign = $storePrintedDesignAction->execute($printedDesignData);

        return new PrintedDesignResource($printedDesign);
    }
}
