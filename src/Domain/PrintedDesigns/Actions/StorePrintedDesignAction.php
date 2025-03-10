<?php

namespace Domain\PrintedDesigns\Actions;

use Domain\PrintedDesigns\DataTransferObjects\CreatePrintedDesignData;
use Domain\PrintedDesigns\Events\PrintedDesignUploaded;
use Domain\PrintedDesigns\Models\PrintedDesign;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class StorePrintedDesignAction
{
    public function __construct(
        private readonly StorePrintedDesignImagesAction $storePrintedDesignImagesAction,
        private readonly StorePrintedDesignSettingsAction $storePrintedDesignSettingsAction) {}

    public function execute(CreatePrintedDesignData $printedDesignData): PrintedDesign
    {
        $printedDesign = new PrintedDesign([
            'title' => $printedDesignData->title,
            'description' => $printedDesignData->description,
        ]);

        $printedDesign->user()->associate(Auth::user());
        // TODO Could shorten this with an associated details method
        $printedDesign->filamentBrand()->associate($printedDesignData->filament_brand_id);
        $printedDesign->filamentColour()->associate($printedDesignData->filament_colour_id);
        $printedDesign->filamentMaterial()->associate($printedDesignData->filament_material_id);
        $printedDesign->save();

        // TODO what happens if the next part fails? Could be worth using a transaction - also make sure to delete any files from storage in the case of an exception. Can't just move this becasuse master images need a printed design ID

        $this->storePrintedDesignImagesAction->execute($printedDesign, $printedDesignData);
        $this->storePrintedDesignSettingsAction->execute($printedDesign, $printedDesignData);

        PrintedDesignUploaded::dispatch($printedDesign);

        $printedDesign->loadMissing(['filamentBrand', 'filamentColour', 'filamentMaterial', 'printedDesignSetting']);

        return $printedDesign;
    }
}
