<?php

namespace App\PrintedDesigns\Controllers;

use App\PrintedDesigns\Requests\StorePrintedDesignRequest;
use App\PrintedDesigns\Resources\PrintedDesignResource;
use Domain\PrintedDesigns\Actions\StorePrintedDesignAction;
use Domain\PrintedDesigns\DataTransferObjects\CreatePrintedDesignData;
use Illuminate\Support\Facades\Auth;

class StorePrintedDesignController
{
    public function __invoke(StorePrintedDesignRequest $request, StorePrintedDesignAction $storePrintedDesignAction): PrintedDesignResource
    {
        $images = collect($request->file('images'))->map(function ($image) {
            return [
                'image' => $image,
            ];
        });

        $printedDesignData = CreatePrintedDesignData::from([
            'title' => data_get($request, 'title'),
            'description' => data_get($request, 'description'),
            'filament_brand_id' => data_get($request, 'filament_brand_id'),
            'filament_colour_id' => data_get($request, 'filament_colour_id'),
            'filament_material_id' => data_get($request, 'filament_material_id'),
            'images' => $images,
            'adhesion_type' => data_get($request, 'adhesion_type'),
            'uses_supports' => data_get($request, 'uses_supports', false),
        ]);

        $printedDesign = $storePrintedDesignAction->execute($printedDesignData, Auth::user());

        return new PrintedDesignResource($printedDesign);
    }
}
