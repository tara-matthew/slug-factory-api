<?php

namespace Domain\PrintedDesigns\Actions;

use Bepsvpt\Blurhash\Facades\BlurHash;
use Domain\PrintedDesigns\DataTransferObjects\UpdatePrintedDesignData;
use Domain\PrintedDesigns\Models\PrintedDesign;
use Illuminate\Support\Facades\Storage;

class UpdatePrintedDesignImagesAction
{
    public function execute(PrintedDesign $printedDesign, UpdatePrintedDesignData $printedDesignData): PrintedDesign
    {
        // TODO Use exception handling

        $newImages = [];

        foreach ($printedDesignData->images as $image) {
            $relativePath = Storage::disk('public')->put('prints', $image->image);
            $path = Storage::disk('public')->path($relativePath);
            $blurHash = BlurHash::encode($path);
            $newImages[] = [
                'url' => $relativePath,
                'blurhash' => $blurHash,
            ];
        }

        $existingImages = $printedDesign->masterImages()->get();
        $existingImages->each(function ($item) {
            $item->delete();
        });

        $printedDesign->masterImages()->createMany($newImages);

        return $printedDesign;
    }
}
