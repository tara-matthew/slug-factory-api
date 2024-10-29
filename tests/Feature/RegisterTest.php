<?php

use App\Users\Controllers\RegisterController;
use App\Users\Requests\RegisterUserRequest;
use Domain\Users\Models\Country;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\Fluent\AssertableJson;
use JMac\Testing\Traits\AdditionalAssertions;

uses(AdditionalAssertions::class);
uses(RefreshDatabase::class);

it('registers a user successfully', function () {
    $country = Country::factory()->create();

    $this->postJson(route('register', [
        'name' => 'Tara',
        'email' => 'tara@gmail.com',
        'username' => 'tara',
        'country_id' => $country->id,
        'password' => 'Password123!',
        'password_confirmation' => 'Password123!',
    ]))
        ->assertCreated()
        ->assertJson(fn (AssertableJson $json) => $json
            ->where('data.name', 'Tara')
            ->where('data.email', 'tara@gmail.com')
            ->where('data.username', 'tara')
            ->where('data.country.id', $country->id)
        );
});

it('creates an empty user profile record upon saving the new user', function () {
    $country = Country::factory()->create();

    $response = $this->postJson(route('register', [
        'name' => 'Tara',
        'email' => 'tara@gmail.com',
        'username' => 'tara',
        'country_id' => $country->id,
        'password' => 'Password123!',
        'password_confirmation' => 'Password123!',
    ]));

    $userID = $response->json()['data']['id'];

    $this->assertDatabaseCount('user_profiles', 1);
    $this->assertDatabaseHas('user_profiles', ['user_id' => $userID]);
});

it('validates using a form request', function () {
    $this->assertActionUsesFormRequest(
        RegisterController::class,
        '__invoke',
        RegisterUserRequest::class
    );
});
