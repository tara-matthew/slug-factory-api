<?php

namespace Domain\Users\DataFactories;

use Domain\Users\DataTransferObjects\UserData;

class UserDataFactory
{
    public static function fromRequest($request): UserData
    {
        return new UserData(...$request->validated());
    }
}
