<?php

namespace Tests\Feature;

use App\Http\Controllers\LoginController;
use App\Http\Requests\LoginUserRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

class LoginControllerTest extends TestCase
{
    use AdditionalAssertions;

    /**
     * @test
     * @covers \App\Http\Controllers\LoginController::__invoke
     */
    public function it_validates_using_a_form_request(): void
    {
        $this->assertActionUsesFormRequest(
            LoginController::class,
            '__invoke',
            LoginUserRequest::class
        );
    }
}
