<?php

namespace Tests\Unit\FormRequest;

use App\Users\Requests\LoginUserRequest;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class LoginUserRequestTest extends TestCase
{
    use AdditionalAssertions;

    private LoginUserRequest $loginUserRequest;

    protected function setUp(): void
    {
        parent::setUp();
        $this->loginUserRequest = new LoginUserRequest();
    }

    #[Test]
    public function it_has_rules_set_up_as_expected()
    {
        $this->assertEquals(
            [
                'username' => 'required',
                'password' => 'required',
            ],
            $this->loginUserRequest->rules()
        );
    }
}
