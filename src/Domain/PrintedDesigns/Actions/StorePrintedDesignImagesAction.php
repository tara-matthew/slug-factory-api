<?php

namespace Domain\PrintedDesigns\Actions;

use Bepsvpt\Blurhash\Facades\BlurHash;
use Domain\PrintedDesigns\DataTransferObjects\CreatePrintedDesignData;
use Domain\PrintedDesigns\Models\PrintedDesign;
use Illuminate\Support\Facades\Storage;

class StorePrintedDesignImagesAction
{
    public function execute(PrintedDesign $printedDesign, CreatePrintedDesignData $printedDesignData): PrintedDesign
    {
        foreach ($printedDesignData->images as $image) {
            $relativePath = Storage::disk('public')->put('prints', $image->image);
            $path = Storage::disk('public')->path($relativePath);
            $blurHash = BlurHash::encode($path);
            $printedDesign->masterImages()->create([
                'url' => $relativePath,
                'blurhash' => $blurHash,
            ]);
        }

        return $printedDesign;
    }
}
