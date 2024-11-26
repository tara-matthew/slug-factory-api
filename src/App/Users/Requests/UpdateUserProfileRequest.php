<?php

namespace App\Users\Requests;

use Domain\Users\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateUserProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        //        $user = User::first(); // TODO change to auth user

        return [
            'email' => ['email', 'unique:users,email,'.Auth::user()->id, 'max:255'],
            'name' => ['string', 'max:255'],
            'bio' => ['nullable', 'string', 'max:500'],
            'avatar_url' => ['nullable', 'string'],
            'country_id' => ['integer', 'exists:countries,id'],
            'profile_set_public_at' => ['nullable', 'date'], // TODO make required
        ];
    }
}
