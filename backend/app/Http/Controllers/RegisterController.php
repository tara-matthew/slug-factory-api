<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use JetBrains\PhpStorm\NoReturn;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class RegisterController extends Controller
{
    public function __construct(private readonly Hash $hash)
    {
    }

    #[NoReturn] public function __invoke(RegisterUserRequest $request): UserResource
    {
        $validated = $request->validated();
        $validated['password'] = $this->hash::make($validated['password']);

        $user = User::create($validated);

        return new UserResource($user);
    }
}
