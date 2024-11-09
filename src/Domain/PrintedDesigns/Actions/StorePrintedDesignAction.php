<?php

namespace Domain\PrintedDesigns\Actions;

use Bepsvpt\Blurhash\Facades\BlurHash;
use Domain\Images\Jobs\ConvertImages;
use Domain\PrintedDesigns\DataTransferObjects\PrintedDesignData;
use Domain\PrintedDesigns\Models\PrintedDesign;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Spatie\Image\Image;

class StorePrintedDesignAction
{
    public function execute(PrintedDesignData $printedDesignData): PrintedDesign
    {
        $printedDesign = PrintedDesign::make([
            'title' => $printedDesignData->title,
            'description' => $printedDesignData->description,
        ]);

        $printedDesign->user()->associate(Auth::user());
        $printedDesign->filamentBrand()->associate($printedDesignData->filament_brand_id);
        $printedDesign->filamentColour()->associate($printedDesignData->filament_colour_id);
        $printedDesign->filamentMaterial()->associate($printedDesignData->filament_material_id);
        $printedDesign->save(); // TODO what happens if the next part fails? Could be worth using a transaction - or move save to below the next chunk

        // TODO move into separate method/action

        foreach ($printedDesignData->images as $image) {
            $relativePath = Storage::disk('public')->put('prints', $image->image);
            $path = Storage::disk('public')->path($relativePath);
            $blurHash = BlurHash::encode($path);
            $printedDesign->masterImages()->create([
                'url' => $relativePath,
                'blurhash' => $blurHash,
//                'is_cover_image' => $image->is_cover_image,
            ]);
        }

//        dd(Storage::disk('local')->url('test.png'));
//        dd(storage_path('app/printedDesigns/' . 'test.png'));
//        dd(storage_path('app/printedDesigns/' . 'test.png'));
//        dd('here');

        // dispatch a job to convert the images
//        ConvertImages::dispatch($printedDesign->masterImages);

        $printedDesign->loadMissing(['filamentBrand', 'filamentColour', 'filamentMaterial']);

        return $printedDesign;
    }
}
