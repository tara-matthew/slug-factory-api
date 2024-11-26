<?php

namespace Domain\PrintedDesigns\Actions;

use Bepsvpt\Blurhash\Facades\BlurHash;
use Domain\PrintedDesigns\DataTransferObjects\CreatePrintedDesignData;
use Domain\PrintedDesigns\Models\PrintedDesign;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class StorePrintedDesignAction
{
    public function __construct(
        private readonly StorePrintedDesignImagesAction $storePrintedDesignImagesAction,
        private readonly StorePrintedDesignSettingsAction $storePrintedDesignSettingsAction)
    {}

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

        $this->storePrintedDesignImagesAction->execute($printedDesign, $printedDesignData);
        $this->storePrintedDesignSettingsAction->execute($printedDesign, $printedDesignData);

        $printedDesign->loadMissing(['filamentBrand', 'filamentColour', 'filamentMaterial']);

        return $printedDesign;
    }
}
