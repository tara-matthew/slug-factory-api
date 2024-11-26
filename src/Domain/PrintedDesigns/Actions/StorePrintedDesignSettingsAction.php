<?php

namespace Domain\PrintedDesigns\Actions;

use Domain\PrintedDesigns\DataTransferObjects\CreatePrintedDesignData;
use Domain\PrintedDesigns\Models\PrintedDesign;

class StorePrintedDesignSettingsAction
{
    public function execute(PrintedDesign $printedDesign, CreatePrintedDesignData $printedDesignData)
    {
        $printedDesign->printedDesignSetting()->create([
            'uses_supports' => $printedDesignData->uses_supports,
            'adhesion_type' => $printedDesignData->adhesion_type,
        ]);

        return $printedDesign;
    }
}
