<?php

namespace App\PrintedDesigns\Controllers;

use App\PrintedDesigns\Resources\PrintedDesignResource;
use Domain\PrintedDesigns\Models\PrintedDesign;
use Domain\Users\Models\User;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;

class IndexMyPrintedDesignsController
{
    public function __invoke(): AnonymousResourceCollection
    {
        /**
         * @var User $user
         */
        $user = Auth::user();

        return PrintedDesignResource::collection(
            PrintedDesign::with(
                [
                    'filamentBrand',
                    'filamentColour',
                    'filamentMaterial',
                ]
            )
                ->whereBelongsTo($user)->paginate(30)
        );
    }
}
