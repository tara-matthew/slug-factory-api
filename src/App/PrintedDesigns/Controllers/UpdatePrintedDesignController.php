<?php

namespace App\PrintedDesigns\Controllers;

use App\PrintedDesigns\Requests\UpdatePrintedDesignRequest;
use App\PrintedDesigns\Resources\PrintedDesignResource;
use Domain\PrintedDesigns\Actions\UpdatePrintedDesignAction;
use Domain\PrintedDesigns\DataTransferObjects\CreatePrintedDesignData;
use Domain\PrintedDesigns\DataTransferObjects\UpdatePrintedDesignData;
use Domain\PrintedDesigns\Models\PrintedDesign;

class UpdatePrintedDesignController
{
    public function __invoke(UpdatePrintedDesignRequest $request, PrintedDesign $printedDesign, UpdatePrintedDesignAction $updatePrintedDesignAction)
    {
        $images = collect($request->file('images'))->map(function ($image) {
            return [
                'image' => $image,
            ];
        });

        $printedDesignData = UpdatePrintedDesignData::from([
            'title' => data_get($request, 'title'),
            'description' => data_get($request, 'description'),
            'filament_brand_id' => data_get($request, 'filament_brand_id'),
            'filament_colour_id' => data_get($request, 'filament_colour_id'),
            'filament_material_id' => data_get($request, 'filament_material_id'),
            'images' => $images,
        ]);

        $updatePrintedDesignAction->execute($printedDesign, $printedDesignData);

        return new PrintedDesignResource($printedDesign);
    }
}
