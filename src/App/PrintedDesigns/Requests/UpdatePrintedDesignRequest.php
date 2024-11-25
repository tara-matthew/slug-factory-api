<?php

namespace App\PrintedDesigns\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePrintedDesignRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => 'sometimes|max:255',
            'description' => 'sometimes',
            'filament_colour_id' => 'sometimes:exists:filament_colours,id',
            'filament_material_id' => 'sometimes:exists:filament_materials,id',
            'images' => 'sometimes|array',
            'images.*.image' => ['sometimes', 'max:4096'],
        ];
    }
}
