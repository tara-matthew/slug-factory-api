<?php

namespace App\Users\Controllers;

use App\Users\Resources\UserResource;
use Illuminate\Support\Facades\Auth;

class ShowUserProfileController
{
    public function __invoke(): UserResource
    {
        return new UserResource(Auth::user());
    }
}
