<?php

namespace Domain\Users\Actions;

use Domain\Users\DataTransferObjects\UserProfileData;
use Domain\Users\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UpdateUserProfileAction
{
    public function handle(UserProfileData $userProfileData): User
    {
        $user = User::first();

        DB::transaction(function () use ($userProfileData, $user) {
            $user->update(array_filter([
                'name' => $userProfileData->name,
                'email' => $userProfileData->email,
                'avatar_url' => $userProfileData->avatar_url,
            ]));

            if (isset($userProfileData->country_id)) {
                $user->country()->associate($userProfileData->country_id)->save();
                $user->load('country');
            }

            $user->userProfile()->update(array_filter([
                'bio' => $userProfileData->bio,
            ]));
        });

        return $user;

    }
}
