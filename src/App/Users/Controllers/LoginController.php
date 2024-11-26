<?php

namespace App\Users\Controllers;

use App\Auth\Resources\AccessTokenResource;
use App\Users\Requests\LoginUserRequest;
use Domain\Users\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class LoginController
{
    public function __invoke(LoginUserRequest $request): JsonResponse|AccessTokenResource
    {
        // TODO move into an action
        $credentials = [
            'username' => $request->username,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {
            $user = User::where('username', $request->username)->first();
            $token = $user->createToken($request->device_name);

            return AccessTokenResource::make($token);
        }

        return response()->json([
            'message' => 'Invalid login',
        ], Response::HTTP_UNAUTHORIZED);

    }
}
