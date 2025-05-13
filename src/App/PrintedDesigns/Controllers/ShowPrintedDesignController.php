<?php

namespace App\PrintedDesigns\Controllers;

use App\PrintedDesigns\Resources\PrintedDesignResource;
use Domain\PrintedDesigns\Models\PrintedDesign;

class ShowPrintedDesignController
{
    public function __invoke(PrintedDesign $printedDesign): PrintedDesignResource
    {
        return new PrintedDesignResource($printedDesign->loadMissing(
            [
                'filamentBrand',
                'filamentColour',
                'filamentMaterial',
                'user',
                'printedDesignSetting',
            ]
        )
            ->loadCount('printedDesignLists'));
    }
}
