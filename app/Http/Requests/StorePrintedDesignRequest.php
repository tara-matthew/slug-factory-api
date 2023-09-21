<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePrintedDesignRequest extends FormRequest
{
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

        ];
    }
}
