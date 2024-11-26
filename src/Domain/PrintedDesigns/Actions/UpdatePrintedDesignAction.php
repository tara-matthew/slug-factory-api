<?php

namespace Domain\PrintedDesigns\Actions;

use Bepsvpt\Blurhash\Facades\BlurHash;
use Domain\PrintedDesigns\DataTransferObjects\UpdatePrintedDesignData;
use Domain\PrintedDesigns\Models\PrintedDesign;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class UpdatePrintedDesignAction
{
    public function execute(PrintedDesign $printedDesign, UpdatePrintedDesignData $printedDesignData)
    {
        $data = array_filter($printedDesignData->toArray(), fn ($i) => ! is_null($i));

        $printedDesign->update($data);

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

        // TODO improve to use separate settings part of DTO

        if (isset($printedDesignData->uses_supports)) {
            $printedDesign->printedDesignSetting()->update([
                'uses_supports' => $printedDesignData->uses_supports,
                'adhesion_type' => $printedDesignData->adhesion_type,
            ]);
        }

        // TODO split out and use a transaction
        // TODO Use exception handling

        if (isset($printedDesignData->images)) {
            $newImages = [];

            foreach ($printedDesignData->images as $image) {
                $relativePath = Storage::disk('public')->put('prints', $image->image);
                $path = Storage::disk('public')->path($relativePath);
                $blurHash = BlurHash::encode($path);
                $newImages[] = [
                    'url' => $relativePath,
                    'blurhash' => $blurHash,
                ];
            }

            $existingImages = $printedDesign->masterImages()->get();
            $existingImages->each(function ($item) {
                $item->delete();
            });

            $printedDesign->masterImages()->createMany($newImages);
        }

        $printedDesign->refresh();
        Log::info($printedDesign);

        return $printedDesign;

    }
}
