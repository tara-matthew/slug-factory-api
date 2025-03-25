<?php

namespace App\PrintedDesignLists\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class AddToPrintedDesignListRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'printed_design_id' => ['required', 'integer', 'exists:printed_designs,id'],
        ];
    }
}
