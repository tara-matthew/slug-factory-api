<?php

namespace App\Users\Controllers;

use App\Users\Requests\UpdateUserProfileRequest;
use App\Users\Resources\UserResource;
use Domain\Users\DataTransferObjects\UserProfileData;
use Domain\Users\Models\User;
use Illuminate\Support\Facades\DB;

class UpdateUserProfileController
{
    public function __invoke(UpdateUserProfileRequest $request)
    {
        $user = User::first();

        $userProfileData = UserProfileData::from($request->validated());

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

        return new UserResource($user);
    }
}
