<?php

namespace App\Users\Controllers;

use App\Users\Requests\RegisterUserRequest;
use App\Users\Resources\UserResource;
use Domain\Users\Actions\SendUserDetailsToThirdPartyAction;
use Domain\Users\Actions\StoreUserAction;
use Domain\Users\DataFactories\UserDataFactory;
use Domain\Users\Models\User;
use Illuminate\Support\Facades\Hash;
use Support\Controllers\Controller;

class RegisterController extends Controller
{
     public function __invoke(RegisterUserRequest $request, StoreUserAction $storeUserAction, SendUserDetailsToThirdPartyAction $sendUserDetailsToThirdPartyAction): UserResource
     {
         $userData = UserDataFactory::fromRequest($request);
         $user = $storeUserAction->execute($userData);
         // TODO should this be injected, or does this mess up SRP?
         // sending everything but the API key
         $sendUserDetailsToThirdPartyAction->execute($userData);

         return new UserResource($user);
     }
}
