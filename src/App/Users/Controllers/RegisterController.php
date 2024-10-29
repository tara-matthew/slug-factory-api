<?php

namespace App\Users\Controllers;

use App\Users\Requests\RegisterUserRequest;
use App\Users\Resources\UserResource;
use Domain\Users\Models\Country;
use Domain\Users\Models\User;
use Illuminate\Support\Facades\Hash;
use Support\Controllers\Controller;

class RegisterController extends Controller
{
    public function __invoke(RegisterUserRequest $request): UserResource
    {
        // TODO could use a UserData DTO and an action here

        $user = User::make([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'password' => Hash::make($request->password)
        ]);

        $country = Country::findOrFail($request->country_id);

        $user->country()->associate($country);

        $user->save();

        return new UserResource($user);
    }
}
