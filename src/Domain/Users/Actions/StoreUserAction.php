<?php

namespace Domain\Users\Actions;
use Domain\Users\DataTransferObjects\UserData;
use Domain\Users\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Domain\Users\Actions\SendUserDetailsToThirdPartyAction;

class StoreUserAction
{
    public function execute(UserData $userData): User
    {
        $userData->password = Hash::make($userData->password);

        return User::create([
            'name' => $userData->name,
            'email' => $userData->email,
            'username' => $userData->username,
            'password' => $userData->password,
            'api_key' => Str::random(32),
            'role' => $userData->role
        ]);
    }
}

