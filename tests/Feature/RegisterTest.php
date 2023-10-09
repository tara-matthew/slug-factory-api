<?php

namespace Tests\Feature;

use App\Users\Controllers\RegisterController;
use App\Users\Requests\RegisterUserRequest;
use Domain\Users\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use JMac\Testing\Traits\AdditionalAssertions;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use AdditionalAssertions;
    use RefreshDatabase;

    /**
     * @test
     * @covers \App\Users\Controllers\RegisterController::__invoke
     */
    public function it_registers_a_user_successfully(): void
    {
        $response = $this->postJson('/auth/register', [
            'name' => 'Tara',
            'email' => 'tara@gmail.com',
            'username' => 'tara',
            'password' => 'Password123!',
            'password_confirmation' => 'Password123!',
        ]);

        $response
            ->assertStatus(ResponseAlias::HTTP_CREATED)
            ->assertJson([
                'data' => [
                    'name' => 'Tara',
                    'email' => 'tara@gmail.com',
                    'username' => 'tara',
                ],
            ]);
    }

    /**
     * @test
     * @covers
     */
    public function it_generates_an_error_message_on_unsuccessful_registration(): void
    {
        $user = User::factory()->create();
        $response = $this->postJson('/auth/register', [
            'name' => $user->name,
            'email' => $user->email,
            'username' => $user->username,
            'password' => 'abc',
            'password_confirmation' => 'abcd',
        ]);

        $response
            ->assertStatus(ResponseAlias::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJson([
                'errors' => [
                    'email' => [
                        'The email has already been taken.',
                    ],
                    'username' => [
                        'The username has already been taken.',
                    ],
                    'password' => [
                        'The password must be at least 8 characters.',
                        'The password must contain at least one uppercase and one lowercase letter.',
                        'The password must contain at least one symbol.',
                        'The password must contain at least one number.',
                        'The password confirmation does not match.',
                    ],
                ],
            ]);
    }

    /**
     * @test
     * @covers
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
