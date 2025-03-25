<?php

namespace App\Filaments\Brands\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFilamentBrandRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
        ];
    }
}
