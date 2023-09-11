<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function __construct(private readonly Hash $hash)
    {
    }

     public function __invoke(RegisterUserRequest $request): UserResource
     {
         $validated = $request->validated();
         $validated['password'] = $this->hash::make($validated['password']);

         $user = User::create($validated);

         return new UserResource($user);
     }
}
