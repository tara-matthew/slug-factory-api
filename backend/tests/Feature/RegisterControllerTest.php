<?php

namespace Tests\Feature;

use App\Http\Controllers\RegisterController;
use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;
use JMac\Testing\Traits\AdditionalAssertions;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Tests\TestCase;

class RegisterControllerTest extends TestCase
{
    use AdditionalAssertions;
    use RefreshDatabase;

    /**
     * @test
     * @covers \App\Http\Controllers\RegisterController::_invoke
     */
    public function it_registers_a_user_successfully(): void
    {
        $response = $this->postJson('/auth/register', [
            'name' => 'Tara',
            'email' => 'tara@gmail.com',
            'username' => 'tara',
            'password' => 'Password123!',
            'password_confirmation' => 'Password123!'
        ]);

        $response
            ->assertStatus(ResponseAlias::HTTP_CREATED)
            ->assertJson([
                'data' => [
                    'user' => [
                        'name' => 'Tara',
                        'email' => 'tara@gmail.com',
                        'username' => 'tara'
                    ]
                ]
            ]);
    }

    /**
     * @test
     * @covers \App\Http\Controllers\RegisterController::_invoke
     */
    public function it_generates_an_error_message_on_unsuccessful_registration(): void
    {
        /**
         * @var User $user
         */
        $user = User::factory()->create();
        $response = $this->postJson('/auth/register', [
            'name' => $user->name,
            'email' => $user->email,
            'username' => $user->username,
            'password' => 'abc',
            'password_confirmation' => 'abcd'
        ]);

        $response
            ->assertStatus(ResponseAlias::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJson([
                'errors' => [
                    'email' => [
                        'The email has already been taken.'
                    ],
                    'username' => [
                        'The username has already been taken.'
                    ],
                    'password' => [
                        "The password must be at least 8 characters.",
                        "The password must contain at least one uppercase and one lowercase letter.",
                        "The password must contain at least one symbol.",
                        "The password must contain at least one number.",
                        "The password confirmation does not match."
                    ]
                ]
            ]);
    }

    /**
     * @test
     * @covers \App\Http\Controllers\RegisterController::__invoke
     */
    public function it_validates_using_a_form_request(): void
    {
        $this->assertActionUsesFormRequest(
            RegisterController::class,
            '__invoke',
            RegisterUserRequest::class
        );
    }
}
