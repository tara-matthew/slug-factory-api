<?php

namespace Domain\Users\DataTransferObjects;

class UserData
{
    public function __construct(
        public string $name,
        public string $email,
        public string $username,
        public string $password,
        public string $role // TODO use the enum
    ){}
}

