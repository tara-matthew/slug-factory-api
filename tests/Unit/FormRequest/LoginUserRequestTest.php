<?php

namespace Tests\Unit\FormRequest;

use App\Users\Requests\LoginUserRequest;
use JMac\Testing\Traits\AdditionalAssertions;

uses(AdditionalAssertions::class);

it('has rules set up correctly', function () {
    $loginUserRequest = new LoginUserRequest();

    $this->assertEquals(
        [
            'username' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'max:255'],
            'device_name' => ['required', 'string', 'max:255'],
        ],

        $loginUserRequest->rules()
    );
});
