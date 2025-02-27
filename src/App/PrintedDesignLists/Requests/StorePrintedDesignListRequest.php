<?php

namespace App\PrintedDesignLists\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePrintedDesignListRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'min:1', 'max:255'],
            'image_url' => ['required', 'url'],
        ];
    }
}
