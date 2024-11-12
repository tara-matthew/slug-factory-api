<?php

use Domain\Users\Models\User;
use Domain\Users\Models\UserProfile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\Fluent\AssertableJson;
use Laravel\Sanctum\Sanctum;

uses(RefreshDatabase::class);

// TODO Make sure favourites_count and prints_count are included in tests

it('displays the profile of the authenticated user', function () {
    $userProfile = UserProfile::factory();
    $user = User::factory()
        ->has($userProfile)->createQuietly();

    $user->loadMissing(['country', 'userProfile']);

    Sanctum::actingAs($user);
    $this->getJson(route('profile.show'))
        ->assertOk()
        ->assertJson(fn (AssertableJson $json) => $json
            ->where('data.id', $user->id)
            ->where('data.name', $user->name)
            ->where('data.username', $user->username)
            ->where('data.avatar_url', $user->avatar_url)
            ->where('data.country.id', $user->country->id)
            ->where('data.country.name', $user->country->name)
            ->where('data.profile.bio', $user->userProfile->bio)
            ->where('data.profile.set_public_at', $user->userProfile->set_public_at)
        );
});
