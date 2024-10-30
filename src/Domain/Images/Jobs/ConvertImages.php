<?php

namespace Domain\Images\Jobs;

use Domain\Images\Models\PrintedDesignMasterImage;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Spatie\Image\Image;

class ConvertImages implements ShouldQueue
{
    use Queueable;

    public function __construct(private readonly Collection $images)
    {
        Log::info($this->images);
    }


    public function handle(): void
    {
        foreach($this->images as $image) {
            Image::load(storage_path('app/' . $image->url))->resize(1024,768)->save();
        }
    }
}
