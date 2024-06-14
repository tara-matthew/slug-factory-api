<?php

namespace Tests\Feature;

use App\Users\Controllers\LoginController;
use App\Users\Requests\LoginUserRequest;
use Domain\Users\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use AdditionalAssertions;
    use RefreshDatabase;

    #[Test]
    public function it_logs_in_a_user_successfully(): void
    {
        /**
         * @var User $user
         */
        $user = User::factory()->create();
        $response = $this->postJson('/auth/login', [
            'username' => $user->username,
            'password' => 'Password123!',
        ]);

        $response
            ->assertStatus(ResponseAlias::HTTP_OK)
            ->assertJson([
                'data' => [
                    'name' => $user->name,
                    'email' => $user->email,
                    'username' => $user->username,
                ],
            ]);
    }

    #[Test]
    public function it_generates_an_error_message_on_unsuccessful_login(): void
    {
        /**
         * @var User $user
         */
        $user = User::factory()->create();
        $response = $this->postJson('/auth/login', [
            'username' => $user->username,
            'password' => 'abc',
        ]);

        $response
            ->assertStatus(ResponseAlias::HTTP_UNAUTHORIZED)
            ->assertJson([
                'message' => 'The provided credentials do not match our records.',
            ]);
    }

    #[Test]
    public function it_validates_using_a_form_request(): void
    {
        $this->assertActionUsesFormRequest(
            LoginController::class,
            '__invoke',
            LoginUserRequest::class
        );
    }
}
