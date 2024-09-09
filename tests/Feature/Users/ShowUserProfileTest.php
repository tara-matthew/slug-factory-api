<?php

use Domain\Users\Models\User;
use Domain\Users\Models\UserProfile;
use Illuminate\Testing\Fluent\AssertableJson;

it('displays the profile of the authenticated user', function () {
    $userProfile = UserProfile::factory();
    $user = User::factory()
        ->has($userProfile)->create();

    asLoggedInUser()
        ->get(route('profile.show'))
        ->assertOk()
        ->assertJson(fn (AssertableJson $json) => $json
            ->where('data.id', $user->id)
            ->where('data.name', $user->name)
            ->where('data.username', $user->username)
            ->where('data.avatar_url', $user->avatar_url)
            ->where('data.profile.bio', $user->userProfile->bio)
        );
});
