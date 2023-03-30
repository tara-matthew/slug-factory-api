<?php

namespace Tests\Feature;

use App\Http\Controllers\RegisterController;
use App\Http\Requests\RegisterUserRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

class RegisterControllerTest extends TestCase
{
    use AdditionalAssertions;

    /**
     * @test
     * @covers \App\Http\Controllers\RegisterController::__invoke
     */
    public function register_controller_validates_using_a_form_request(): void
    {
        $this->assertActionUsesFormRequest(
            RegisterController::class,
            '__invoke',
            RegisterUserRequest::class
        );
    }
}
