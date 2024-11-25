<?php

namespace App\PrintedDesigns\Controllers;

use App\PrintedDesigns\Requests\UpdatePrintedDesignRequest;
use App\PrintedDesigns\Resources\PrintedDesignResource;
use Domain\PrintedDesigns\Actions\UpdatePrintedDesignAction;
use Domain\PrintedDesigns\DataTransferObjects\CreatePrintedDesignData;
use Domain\PrintedDesigns\DataTransferObjects\UpdatePrintedDesignData;
use Domain\PrintedDesigns\Models\PrintedDesign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UpdatePrintedDesignController
{
    public function __invoke(UpdatePrintedDesignRequest $request, PrintedDesign $printedDesign, UpdatePrintedDesignAction $updatePrintedDesignAction)
    {
        if ($request->file('images') !== null) {
            $images = collect($request->file('images'))->map(function ($image) {
                return [
                    'image' => $image,
                ];
            });
        }


        Log::info(data_get($request, 'filament_brand_id'));

//        Log::info($images);
//        Log::info(json_encode($images));
//        Log::info(json_encode($printedDesign->masterImages));

        $printedDesignData = UpdatePrintedDesignData::from([
            'title' => data_get($request, 'title'),
            'description' => data_get($request, 'description'),
            'filament_brand_id' => data_get($request, 'filament_brand_id'),
            'filament_colour_id' => data_get($request, 'filament_colour_id'),
            'filament_material_id' => data_get($request, 'filament_material_id'),
            'images' => $images ?? null,
            'uses_supports' => $request->has('uses_supports') ? $request->uses_supports : false
        ]);

        $updatePrintedDesignAction->execute($printedDesign, $printedDesignData);

        return new PrintedDesignResource($printedDesign);
    }
}
