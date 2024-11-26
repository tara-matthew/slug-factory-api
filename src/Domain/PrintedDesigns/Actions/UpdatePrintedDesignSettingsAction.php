<?php

namespace Domain\PrintedDesigns\Actions;

use Domain\PrintedDesigns\DataTransferObjects\CreatePrintedDesignData;
use Domain\PrintedDesigns\DataTransferObjects\UpdatePrintedDesignData;
use Domain\PrintedDesigns\Models\PrintedDesign;

class UpdatePrintedDesignSettingsAction
{
    public function execute(PrintedDesign $printedDesign, UpdatePrintedDesignData $printedDesignData)
    {
        // TODO improve to use separate settings part of DTO

        $printedDesign->printedDesignSetting()->update([
            'uses_supports' => $printedDesignData->uses_supports,
            'adhesion_type' => $printedDesignData->adhesion_type,
        ]);

        return $printedDesign;
    }
}
