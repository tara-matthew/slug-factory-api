<?php

namespace App\Http\Controllers;

use App\PrintedDesignLists\Models\PrintedDesignList;
use App\PrintedDesignLists\Resources\PrintedDesignListResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;

class IndexMyPrintedDesignListsController
{
    public function __invoke(): AnonymousResourceCollection
    {
        $user = Auth::user();

        return PrintedDesignListResource::collection(PrintedDesignList::whereBelongsTo($user)->paginate(30));
    }
}
