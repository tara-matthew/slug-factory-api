<?php

use App\Users\Requests\RegisterUserRequest;
use Illuminate\Validation\Rules\Password;

it('has rules set up as expected', function () {
    $registerUserRequest = new RegisterUserRequest;

    $this->assertEquals(
        [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users|max:255',
            'username' => 'required|unique:users|max:255',
            'country_id' => 'required|exists:countries,id',
            'password' => [Password::defaults(), 'required', 'confirmed'],
        ],
        $registerUserRequest->rules()
    );
});
