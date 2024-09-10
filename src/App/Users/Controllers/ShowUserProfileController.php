<?php

namespace App\Users\Controllers;

use App\Users\Resources\UserResource;
use Domain\Users\Models\User;

class ShowUserProfileController
{
    public function __invoke()
    {
        $user = User::with(['userProfile', 'country'])->first(); // auth user

        return new UserResource($user);
    }
}
