<?php

namespace App\Users\Controllers;

use App\Users\Requests\UpdateUserProfileRequest;
use App\Users\Resources\UserResource;
use Domain\Users\Actions\UpdateUserProfileAction;
use Domain\Users\DataTransferObjects\UserProfileData;
use Illuminate\Support\Facades\Auth;

class UpdateUserProfileController
{
    public function __invoke(UpdateUserProfileRequest $request, UpdateUserProfileAction $updateUserProfileAction): UserResource
    {
        $userProfileData = UserProfileData::from($request->validated());

        $user = $updateUserProfileAction->handle($userProfileData, Auth::user());

        return new UserResource($user);
    }
}
