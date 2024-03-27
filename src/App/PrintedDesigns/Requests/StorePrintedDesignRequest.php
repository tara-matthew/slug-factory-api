<?php

namespace App\PrintedDesigns\Requests;

use Domain\PrintedDesigns\DataTransferObjects\PrintedDesignData;
use Illuminate\Foundation\Http\FormRequest;
use Spatie\LaravelData\WithData;

class StorePrintedDesignRequest extends FormRequest
{
//    use WithData;
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|max:255',
            'description' => 'required',
            'user_id' => 'required|exists:users,id',
            'filament_brand_id' => 'required',
            'filament_colour_id' => 'required',
            'images.*.url' => 'required',
            'images.*.is_cover_image' => 'required|bool',

        ];
    }

//    protected function dataClass(): string
//    {
//        return PrintedDesignData::class;
//    }
}
