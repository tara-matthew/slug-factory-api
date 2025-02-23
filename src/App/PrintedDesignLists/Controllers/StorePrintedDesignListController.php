<?php

namespace App\PrintedDesignLists\Controllers;

use App\PrintedDesignLists\Models\PrintedDesignList;
use App\PrintedDesignLists\Requests\StorePrintedDesignListRequest;
use App\PrintedDesignLists\Resources\PrintedDesignListResource;
use Illuminate\Support\Facades\Auth;

class StorePrintedDesignListController
{
    public function __invoke(StorePrintedDesignListRequest $request)
    {
        $user = Auth::user();

        $validated = $request->validated();

        $printedDesignList = new PrintedDesignList([
            'name' => $validated['name'],
        ]);

        $printedDesignList->user()->associate($user);

        $printedDesignList->save();

        return new PrintedDesignListResource($printedDesignList);

    }
}
