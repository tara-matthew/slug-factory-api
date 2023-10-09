<?php

namespace Support\Contracts;

use Domain\Users\DataTransferObjects\UserData;

interface ExternalService
{
    public function passUserDetails(UserData $data);
}
