<?php

namespace App\PrintedDesignLists\Controllers;

use App\PrintedDesignLists\Requests\StorePrintedDesignListRequest;
use App\PrintedDesignLists\Resources\PrintedDesignListResource;
use Domain\PrintedDesignLists\Actions\StorePrintedDesignListAction;
use Domain\PrintedDesignLists\DataTransferObjects\CreatePrintedDesignListData;

class StorePrintedDesignListController
{
    public function __invoke(StorePrintedDesignListRequest $request, StorePrintedDesignListAction $storePrintedDesignListAction): PrintedDesignListResource
    {
        $listData = CreatePrintedDesignListData::from([
            'name' => data_get($request, 'name'),
        ]);

        $list = $storePrintedDesignListAction->execute($listData);

        return new PrintedDesignListResource($list);

    }
}
