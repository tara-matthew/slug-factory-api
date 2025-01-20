<?php

use App\Users\Requests\UpdateUserProfileRequest;
use Domain\Users\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

uses(RefreshDatabase::class, TestCase::class);

it('has rules set up correctly', function () {
    $updateUserProfileRequest = new UpdateUserProfileRequest;

    $user = User::factory()->create();

    Sanctum::actingAs($user);

    $this->assertEquals([
        'email' => ['email', 'unique:users,email,'.$user->id, 'max:255'],
        'name' => ['string', 'max:255'],
        'bio' => ['nullable', 'string', 'max:500'],
        'avatar_url' => ['nullable', 'string'],
        'country_id' => ['integer', 'exists:countries,id'],
        'profile_set_public_at' => ['nullable', 'date'],
    ], $updateUserProfileRequest->rules());
});
