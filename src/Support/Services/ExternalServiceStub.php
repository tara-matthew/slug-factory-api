<?php

namespace Support\Services;

use Domain\Users\DataTransferObjects\UserData;
use Illuminate\Http\JsonResponse;
use Support\Contracts\ExternalService;

class ExternalServiceStub implements ExternalService
{
    public function passUserDetails(UserData $data): void
    {
        // Pass the user details to the external service
        // If it needs a token, this will already have been added in the service provider


    }
}
