<?php

namespace App\Users\Controllers;

use App\Users\Requests\UpdateUserProfileRequest;
use App\Users\Resources\UserResource;
use Domain\Users\Actions\UpdateUserProfileAction;
use Domain\Users\DataTransferObjects\UserProfileData;
use Domain\Users\Models\User;
use Illuminate\Support\Facades\Auth;

class UpdateUserProfileController
{
    public function __invoke(UpdateUserProfileRequest $request, UpdateUserProfileAction $updateUserProfileAction): UserResource
    {
        $userProfileData = UserProfileData::from($request->validated());

        /**
         * @var User $user
         */
        $user = Auth::user();

        $user = $updateUserProfileAction->handle($userProfileData, $user);

        return new UserResource($user);
    }
}
