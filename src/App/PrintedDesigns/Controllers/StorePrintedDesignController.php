<?php

namespace App\PrintedDesigns\Controllers;

use App\PrintedDesigns\Requests\StorePrintedDesignRequest;
use App\PrintedDesigns\Resources\PrintedDesignResource;
use Domain\PrintedDesigns\Actions\StorePrintedDesignAction;
use Domain\PrintedDesigns\DataTransferObjects\PrintedDesignData;

class StorePrintedDesignController
{
    public function __invoke(StorePrintedDesignRequest $request, StorePrintedDesignAction $storePrintedDesignAction): PrintedDesignResource
    {
        $printedDesignData = PrintedDesignData::from($request->validated());
        $printedDesign = $storePrintedDesignAction->execute($printedDesignData);

        return new PrintedDesignResource($printedDesign);
    }
}
