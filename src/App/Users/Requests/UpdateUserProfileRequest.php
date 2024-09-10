<?php

namespace App\Users\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => ['email', 'unique:users,email', 'max:255'],
            'name' => ['string', 'max:255'],
            'bio' => ['nullable', 'string', 'max:500'],
            'avatar_url' => ['nullable', 'string'],
            'country_id' => ['integer', 'exists:countries,id'],
        ];
    }
}
