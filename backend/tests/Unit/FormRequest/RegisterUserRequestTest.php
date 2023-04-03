<?php

namespace Tests\Unit\FormRequest;

use App\Http\Requests\RegisterUserRequest;
use Illuminate\Validation\Rules\Password;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

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
                'password' => [Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols(),'required','confirmed'],
            ],
            $this->registerUserRequest->rules()
        );
    }
}
