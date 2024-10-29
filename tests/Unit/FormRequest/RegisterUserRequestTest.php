<?php

namespace Tests\Unit\FormRequest;

use App\Users\Requests\RegisterUserRequest;
use Illuminate\Validation\Rules\Password;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class RegisterUserRequestTest extends TestCase
{
    use AdditionalAssertions;

    private RegisterUserRequest $registerUserRequest;

    protected function setUp(): void
    {
        parent::setUp();
        $this->registerUserRequest = new RegisterUserRequest;
    }

    #[Test]
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
                    ->symbols(), 'required', 'confirmed', ],
            ],
            $this->registerUserRequest->rules()
        );
    }
}
