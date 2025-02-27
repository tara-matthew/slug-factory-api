<?php

namespace App\PrintedDesignLists\Controllers;

use App\PrintedDesignLists\Models\PrintedDesignList;
use App\PrintedDesignLists\Resources\PrintedDesignListResource;

class ShowPrintedDesignListController
{
    public function __invoke(PrintedDesignList $printedDesignList): PrintedDesignListResource
    {
        return new PrintedDesignListResource(
            $printedDesignList->loadMissing(
                'printedDesigns'
            )
        );
    }
}
