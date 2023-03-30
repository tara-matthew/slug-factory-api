<?php

namespace Tests\Feature;

use App\Http\Requests\RegisterUserRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Validation\Rules\Password;
use Tests\TestCase;
use JMac\Testing\Traits\AdditionalAssertions;

class RegisterUserRequestTest extends TestCase
{
    use AdditionalAssertions;

    private RegisterUserRequest $registerUserRequest;

    protected function setUp(): void
    {
        parent::setUp();
        $this->registerUserRequest = new RegisterUserRequest();
    }

    /**
     * @test
     */
    public function it_has_rules_set_up_as_expected()
    {
        $this->assertEquals(
            [
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users|max:255',
                'username' => 'required|unique:users|max:255',
                'password' => ['required','confirmed',Password::min(8)]
            ],
            $this->registerUserRequest->rules()
        );
    }
}
