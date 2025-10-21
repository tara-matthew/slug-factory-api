<?php

declare(strict_types=1);

namespace Domain\Filaments\Brands\DataTransferObjects;

use Spatie\LaravelData\Data;

class FilamentBrandData extends Data
{
    public function __construct(
        public string $name,
    ) {}
}
