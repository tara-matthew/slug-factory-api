<?php

namespace Domain\Users\Actions;

use Carbon\Carbon;
use Domain\Users\DataTransferObjects\UserProfileData;
use Domain\Users\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UpdateUserProfileAction
{
    public function handle(UserProfileData $userProfileData): User
    {
        /**
         * @var User $user
         */
        $user = Auth::user();

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
                'set_public_at' => Carbon::parse($userProfileData->profile_set_public_at),
            ]));
        });

        $user->refresh();

        return $user;

    }
}
