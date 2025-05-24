<?php

namespace App\PrintedDesignLists\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePrintedDesignPrintedDesignListsRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'printed_design_list_add_ids' => ['sometimes', 'array'],
            'printed_design_list_remove_ids' => ['sometimes', 'array'],
            'printed_design_list_add_ids.*' => ['sometimes', 'integer', 'exists:printed_design_lists,id'],
            'printed_design_list_remove_ids.*' => ['sometimes', 'integer', 'exists:printed_design_lists,id'],
        ];
    }
}
