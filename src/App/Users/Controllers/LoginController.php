<?php

namespace App\Users\Controllers;

use App\Auth\Resources\AccessTokenResource;
use App\Users\Requests\LoginUserRequest;
use App\Users\Resources\UserResource;
use Domain\Users\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class LoginController
{
    public function __invoke(LoginUserRequest $request): JsonResponse|AccessTokenResource
    {
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
            'message' => 'The provided credentials do not match our records.',
        ], Response::HTTP_UNAUTHORIZED);

    }
}
