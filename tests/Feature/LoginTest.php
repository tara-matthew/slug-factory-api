<?php

use App\Users\Controllers\LoginController;
use App\Users\Requests\LoginUserRequest;
use Domain\Users\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

uses(RefreshDatabase::class);

it('logs in a user', function () {
    $user = User::factory()->create();

    $this->postJson(route('login', [
        'username' => $user->username,
        'password' => 'Password123!',
        'device_name' => 'Test device',
    ]))
        ->assertOk()
        ->assertJsonStructure([
            'data' => [
                'token',
            ],
        ]);
});

it('returns an error code on unsuccessful login', function () {
    $user = User::factory()->create();
    $response = $this->postJson(route('login'), [
        'username' => $user->username,
        'password' => 'abc',
        'device_name' => 'Test device',
    ]);

    $response
        ->assertStatus(ResponseAlias::HTTP_UNAUTHORIZED)
        ->assertJson([
            'message' => 'Invalid login',
        ]);
});

it('validates using a form request', function () {
    $this->assertActionUsesFormRequest(
        LoginController::class,
        '__invoke',
        LoginUserRequest::class
    );
});
