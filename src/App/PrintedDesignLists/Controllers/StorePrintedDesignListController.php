<?php

namespace App\PrintedDesignLists\Controllers;

use App\PrintedDesignLists\Requests\StorePrintedDesignListRequest;
use App\PrintedDesignLists\Resources\PrintedDesignListResource;
use Domain\PrintedDesignLists\Actions\StorePrintedDesignListAction;
use Domain\PrintedDesignLists\DataTransferObjects\CreatePrintedDesignListData;
use Illuminate\Support\Facades\Auth;

class StorePrintedDesignListController
{
    public function __invoke(StorePrintedDesignListRequest $request, StorePrintedDesignListAction $storePrintedDesignListAction): PrintedDesignListResource
    {
        $listData = CreatePrintedDesignListData::from([
            'title' => data_get($request, 'title'),
            'image_url' => data_get($request, 'image_url'),
        ]);

        $list = $storePrintedDesignListAction->execute($listData, Auth::user());

        return new PrintedDesignListResource($list);

    }
}
