<?php

namespace Domain\Images\Jobs;

use Domain\Images\Models\PrintedDesignMasterImage;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Spatie\Image\Enums\CropPosition;
use Spatie\Image\Enums\Fit;
use Spatie\Image\Image;

class ConvertImages
{
    use Queueable;

    public function __construct(private readonly Collection $images)
    {
        Log::info($this->images);
    }


    public function handle(): void
    {
        foreach($this->images as $image) {
            try {
            Image::load(storage_path('app/public/' . $image->url)) ->fit(fit: Fit::Crop, desiredWidth:  640,  desiredHeight: 480, backgroundColor: '#ff5733')->save();
            } catch (\Exception $e) {
                Log::error($e->getMessage());
            }
            }
    }
}
