<?php

namespace Domain\PrintedDesigns\Actions;

use Bepsvpt\Blurhash\Facades\BlurHash;
use Domain\PrintedDesigns\DataTransferObjects\CreatePrintedDesignData;
use Domain\PrintedDesigns\Models\PrintedDesign;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Throwable;

class StorePrintedDesignImagesAction
{
    public function execute(PrintedDesign $printedDesign, CreatePrintedDesignData $printedDesignData): PrintedDesign
    {
        return DB::transaction(function () use ($printedDesign, $printedDesignData) {
            $savedFiles = [];

            try {
                foreach ($printedDesignData->images as $image) {
                    $relativePath = Storage::disk('public')->put('prints', $image->image);
                    $path = Storage::disk('public')->path($relativePath);
                    $blurHash = BlurHash::encode($path);

                    $printedDesign->masterImages()->create([
                        'url' => $relativePath,
                        'blurhash' => $blurHash,
                    ]);

                    $savedFiles[] = $relativePath;
                }
            } catch (Throwable $e) {
                // Cleanup any saved images if an error occurs
                foreach ($savedFiles as $file) {
                    Storage::disk('public')->delete($file);
                }
                throw $e;
            }

            return $printedDesign;
        });
    }
}
