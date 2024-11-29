<?php

namespace App\PrintedDesigns\Requests;

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
            'filament_brand_id' => 'sometimes:exists:filament_brands,id',
            'filament_colour_id' => 'sometimes:exists:filament_colours,id',
            'filament_material_id' => 'required:exists:filament_materials,id',
            'images' => 'required|array',
            'images.*.image' => ['required', 'max:4096'],
            //            'images.*.is_cover_image' => 'required|bool',
            'uses_supports' => 'sometimes|bool',
            'adhesion_type' => 'required|string',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'uses_supports' => filter_var($this->input('uses_supports'), FILTER_VALIDATE_BOOLEAN),
        ]);
    }

    //    protected function dataClass(): string
    //    {
    //        return PrintedDesignData::class;
    //    }
}
