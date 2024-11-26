<?php

namespace App\Images\Controllers;

use Domain\Images\Jobs\ConvertImages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class TestImageUploadController
{
    public function __invoke(Request $request)
    {
//        Log::info('Test image upload');
        Log::info($request->file('images'));
        Log::info(json_encode($request->all()));

        try {
            $url = Storage::disk('public')->put('prints', $request->file);
        }catch (\Exception $e) {
            Log::error($e->getMessage());
        }

        ConvertImages::dispatch($url);



    }
}
