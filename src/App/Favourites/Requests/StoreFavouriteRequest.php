<?php

namespace App\Favourites\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFavouriteRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'type' => ['required', 'string', 'in:printed_design,filament_brand'],
        ];
    }
}
