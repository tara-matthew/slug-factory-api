<?php

namespace Domain\PrintedDesigns\Actions;

use Bepsvpt\Blurhash\Facades\BlurHash;
use Domain\Images\Jobs\ConvertImages;
use Domain\PrintedDesigns\DataTransferObjects\CreatePrintedDesignData;
use Domain\PrintedDesigns\Models\PrintedDesign;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Spatie\Image\Image;

class StorePrintedDesignAction
{
    public function execute(CreatePrintedDesignData $printedDesignData): PrintedDesign
    {
        Log::info(json_encode($printedDesignData));
        $printedDesign = PrintedDesign::make([
            'title' => $printedDesignData->title,
            'description' => $printedDesignData->description,
        ]);

        $printedDesign->user()->associate(Auth::user());
        $printedDesign->filamentBrand()->associate($printedDesignData->filament_brand_id);
        $printedDesign->filamentColour()->associate($printedDesignData->filament_colour_id);
        $printedDesign->filamentMaterial()->associate($printedDesignData->filament_material_id);
        $printedDesign->save(); // TODO what happens if the next part fails? Could be worth using a transaction - also make sure to delete any files from storage in the case of an exception. Can't just move this becasuse master images need a printed design ID

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

        $printedDesign->printedDesignSetting()->create([
           'uses_supports' => $printedDesignData->uses_supports,
        ]);

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
