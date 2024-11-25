<?php

namespace Domain\PrintedDesigns\Actions;

use Bepsvpt\Blurhash\Facades\BlurHash;
use Domain\PrintedDesigns\DataTransferObjects\UpdatePrintedDesignData;
use Domain\PrintedDesigns\Models\PrintedDesign;
use Illuminate\Support\Facades\Storage;

class UpdatePrintedDesignAction {
    public function execute(PrintedDesign $printedDesign, UpdatePrintedDesignData $printedDesignData)
    {
        $data = array_filter($printedDesignData->toArray(), fn ($i) => ! is_null($i));

        $printedDesign->update($data);

        // TODO split out and use a transaction

        if (isset($printedDesignData->images)) {
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
            foreach ($existingImages as $image) {
                $image->delete();
            }
            $printedDesign->masterImages()->createMany($newImages);
        }

        $printedDesign->refresh();

        return $printedDesign;

    }
}
