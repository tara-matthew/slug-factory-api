<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class StorePrintedDesignRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    #[ArrayShape(['title' => "string", 'description' => "string", 'user_id' => "string"])] public function rules(): array
    {
        return [
            'title' => 'required|max:255',
            'description' => 'required',
            'user_id' => 'required|exists:users,id'

        ];
    }
}
