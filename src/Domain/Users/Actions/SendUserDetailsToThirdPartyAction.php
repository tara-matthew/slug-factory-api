<?php

namespace Domain\Users\Actions;

use Support\Contracts\ExternalService;

class SendUserDetailsToThirdPartyAction
{
    public function __construct(
        protected ExternalService $externalService
    ){}
    public function execute($data): void
    {
        $this->externalService->passUserDetails($data);
    }
}
