<?php

namespace App\Users\Controllers;

use App\Users\Requests\LoginUserRequest;
use App\Users\Resources\UserResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Support\Controllers\Controller;

class LoginController extends Controller
{
    public function __invoke(LoginUserRequest $request): UserResource | JsonResponse
    {
        $validated = $request->validated();
        if (! Auth::attempt($validated)) {
            return response()->json([
                'message' => 'The provided credentials do not match our records.',
            ], 401);
        }

        $user = $request->user();

        return new UserResource($user);
    }
}
