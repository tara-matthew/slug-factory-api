<?php

namespace App\Users\Controllers;

use App\Users\Requests\RegisterUserRequest;
use App\Users\Resources\UserResource;
use Domain\Users\Models\User;
use Illuminate\Support\Facades\Hash;
use Support\Controllers\Controller;

class RegisterController extends Controller
{
     public function __invoke(RegisterUserRequest $request): UserResource
     {
         $validated = $request->validated();
         $validated['password'] = Hash::make($validated['password']);

         $user = User::create($validated);

         return new UserResource($user);
     }
}
