<?php

namespace Domain\PrintedDesignLists\Actions;

use App\PrintedDesignLists\Models\PrintedDesignList;
use Domain\PrintedDesignLists\DataTransferObjects\CreatePrintedDesignListData;
use Domain\Users\Models\User;

class StorePrintedDesignListAction
{
    public function execute(CreatePrintedDesignListData $printedDesignListData, User $user): PrintedDesignList
    {
        $printedDesignList = new PrintedDesignList([
            'title' => $printedDesignListData->title,
            'image_url' => $printedDesignListData->image_url,
        ]);

        $printedDesignList->user()->associate($user);

        $printedDesignList->save();

        return $printedDesignList;
    }
}
