<?php

namespace Domain\PrintedDesigns\Actions;

use Domain\PrintedDesigns\DataTransferObjects\UpdatePrintedDesignData;
use Domain\PrintedDesigns\Models\PrintedDesign;

class UpdatePrintedDesignAction
{
    public function __construct(
        private readonly UpdatePrintedDesignAssociatedDetails $updatePrintedDesignAssociatedDetails,
        private readonly UpdatePrintedDesignSettingsAction $updatePrintedDesignSettingsAction,
        private readonly UpdatePrintedDesignImagesAction $updatePrintedDesignImagesAction,
    ) {}

    // TODO use a transaction
    public function execute(PrintedDesign $printedDesign, UpdatePrintedDesignData $printedDesignData): PrintedDesign
    {
        $data = array_filter($printedDesignData->toArray(), fn ($i) => ! is_null($i));

        $printedDesign->update($data);

        $this->updatePrintedDesignAssociatedDetails->execute($printedDesign, $printedDesignData);

        if (isset($printedDesignData->uses_supports)) {
            $this->updatePrintedDesignSettingsAction->execute($printedDesign, $printedDesignData);
        }

        if (isset($printedDesignData->images)) {
            $this->updatePrintedDesignImagesAction->execute($printedDesign, $printedDesignData);
        }

        // TODO May not need this once view print screen is sorted on the frontend
        $printedDesign->loadMissing(['filamentMaterial', 'printedDesignSetting']);

        $printedDesign->refresh();

        return $printedDesign;

    }
}
