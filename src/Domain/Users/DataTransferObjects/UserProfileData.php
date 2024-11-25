<?php

namespace Domain\Users\DataTransferObjects;

use Carbon\Carbon;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\DateTimeInterfaceCast;
use Spatie\LaravelData\Data;

class UserProfileData extends Data
{
    public function __construct(
        public ?int $id,
        public ?string $name,
        public ?string $email,
        public ?string $avatar_url,
        public ?string $bio,
        public ?int $country_id,
        public ?string $profile_set_public_at
    ) {}
}
