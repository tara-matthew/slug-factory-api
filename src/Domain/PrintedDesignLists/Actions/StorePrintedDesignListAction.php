<?php

namespace Domain\PrintedDesignLists\Actions;

use App\PrintedDesignLists\Models\PrintedDesignList;
use Domain\PrintedDesignLists\DataTransferObjects\CreatePrintedDesignListData;
use Illuminate\Support\Facades\Auth;

class StorePrintedDesignListAction
{
    public function execute(CreatePrintedDesignListData $printedDesignListData): PrintedDesignList
    {
        $printedDesignList = new PrintedDesignList([
            'name' => $printedDesignListData->name,
        ]);

        $printedDesignList->user()->associate(Auth::user());

        $printedDesignList->save();

        return $printedDesignList;
    }
}
