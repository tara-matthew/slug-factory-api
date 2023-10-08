<?php

namespace App\Users\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegisterUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users|max:255',
            'username' => 'required|unique:users|max:255',
            'password' => [Password::defaults(), 'required', 'confirmed'],
        ];
    }
}
