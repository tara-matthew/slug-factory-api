<?php

use App\Users\Resources\UserResource;
use Domain\Users\Models\Country;
use Domain\Users\Models\User;
use Domain\Users\Models\UserProfile;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('updates the profile of the authenticated user', function () {
    $userProfile = UserProfile::factory();
    $user = User::factory()
        ->has($userProfile)->create();

    $newCountry = Country::factory()->create();

    $response = asLoggedInUser()
        ->patchJson(route('profile.update'), [
            'email' => 'new-email@example.com',
            'bio' => 'new bio',
            'country_id' => $newCountry->id,
            'avatar_url' => 'new-avatar.com',
        ])
        ->assertOk();

    $user->refresh();

    $user->loadMissing(['country', 'userProfile']);

    $this->assertJsonResponseContent(UserResource::make($user), $response);

    $this->assertSame('new-email@example.com', $user->email);
    $this->assertSame('new bio', $user->userProfile->bio);
    $this->assertSame($newCountry->id, $user->country_id);
    $this->assertSame('new-avatar.com', $user->avatar_url);
});

it('does not partially update if part of the request fails', function () {
    $userProfile = UserProfile::factory([
        'bio' => 'test bio',
    ]);

    $user = User::factory([
        'email' => 'test@test.com',
        'avatar_url' => 'test-avatar-url',
    ])->has($userProfile)->create();

    asLoggedInUser()
        ->patchJson(route('profile.update'), [
            'email' => 'invalid-email',
            'bio' => 'new bio',
            'avatar_url' => 'new-avatar.com',
        ])->assertUnprocessable();

    $user->refresh();

    $this->assertSame('test@test.com', $user->email);
    $this->assertSame('test bio', $user->userProfile->bio);
    $this->assertSame('test-avatar-url', $user->avatar_url);
});
