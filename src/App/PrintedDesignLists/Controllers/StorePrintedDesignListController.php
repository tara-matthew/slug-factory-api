<?php

namespace App\PrintedDesignLists\Controllers;

use App\PrintedDesignLists\Requests\StorePrintedDesignListRequest;
use App\PrintedDesignLists\Resources\PrintedDesignListResource;
use Domain\PrintedDesignLists\Actions\StorePrintedDesignListAction;
use Domain\PrintedDesignLists\DataTransferObjects\CreatePrintedDesignListData;
use Domain\Users\Models\User;
use Illuminate\Support\Facades\Auth;

class StorePrintedDesignListController
{
    public function __invoke(StorePrintedDesignListRequest $request, StorePrintedDesignListAction $storePrintedDesignListAction): PrintedDesignListResource
    {
        $listData = CreatePrintedDesignListData::from([
            'title' => data_get($request, 'title'),
            'image_url' => data_get($request, 'image_url'),
        ]);

        /**
         * @var User $user
         */
        $user = Auth::user();

        $list = $storePrintedDesignListAction->execute($listData, $user);

        return new PrintedDesignListResource($list);

    }
}
