<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __invoke(LoginUserRequest $request): UserResource | JsonResponse
    {
        $validated = $request->validated();
        if (!Auth::attempt($validated)) {
            return response()->json([
                'message' => 'The provided credentials do not match our records.'
            ], 401);
        }

        $user = $request->user();

        return new UserResource($user);
    }
}
