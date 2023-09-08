<?php

namespace App\Actions;

use App\DataTransferObjects\PrintedDesignData;
use App\Models\PrintedDesign;
use Illuminate\Http\Request;

class StorePrintedDesignAction
{
    public function execute(PrintedDesignData $printedDesignData): PrintedDesign
    {
        $printedDesign = PrintedDesign::create([
            'title' => $printedDesignData->title,
            'description' => $printedDesignData->description,
            'user_id' => $printedDesignData->user_id
        ]);
        foreach ($printedDesignData->images as $image) {
            $printedDesign->images()->create([
                'url' => $image['url']
            ]);
        }

        return $printedDesign;
    }

}
