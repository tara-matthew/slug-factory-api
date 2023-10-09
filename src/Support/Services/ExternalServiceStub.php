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
        // Is it worth returning a response here?
        // May need error handling, depending on how the third party api works, although ideally the shape of data it expects would conform to the DTO
        // May want to return the object which it creates

    }
}
