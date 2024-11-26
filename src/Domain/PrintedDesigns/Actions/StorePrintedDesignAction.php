<?php

namespace Domain\PrintedDesigns\Actions;

use Bepsvpt\Blurhash\Facades\BlurHash;
use Domain\PrintedDesigns\DataTransferObjects\CreatePrintedDesignData;
use Domain\PrintedDesigns\Models\PrintedDesign;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class StorePrintedDesignAction
{
    public function execute(CreatePrintedDesignData $printedDesignData): PrintedDesign
    {
        $printedDesign = PrintedDesign::make([
            'title' => $printedDesignData->title,
            'description' => $printedDesignData->description,
        ]);

        $printedDesign->user()->associate(Auth::user());
        $printedDesign->filamentBrand()->associate($printedDesignData->filament_brand_id);
        $printedDesign->filamentColour()->associate($printedDesignData->filament_colour_id);
        $printedDesign->filamentMaterial()->associate($printedDesignData->filament_material_id);
        $printedDesign->save(); // TODO what happens if the next part fails? Could be worth using a transaction - also make sure to delete any files from storage in the case of an exception. Can't just move this becasuse master images need a printed design ID

        // TODO move into separate method/action

        foreach ($printedDesignData->images as $image) {
            $relativePath = Storage::disk('public')->put('prints', $image->image);
            $path = Storage::disk('public')->path($relativePath);
            $blurHash = BlurHash::encode($path);
            $printedDesign->masterImages()->create([
                'url' => $relativePath,
                'blurhash' => $blurHash,
            ]);
        }

        $printedDesign->printedDesignSetting()->create([
            'uses_supports' => $printedDesignData->uses_supports,
            'adhesion_type' => $printedDesignData->adhesion_type,
        ]);

        $printedDesign->loadMissing(['filamentBrand', 'filamentColour', 'filamentMaterial']);

        return $printedDesign;
    }
}
