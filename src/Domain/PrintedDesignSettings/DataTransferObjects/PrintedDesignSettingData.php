<?php

declare(strict_types=1);

namespace Domain\PrintedDesignSettings\DataTransferObjects;

use Spatie\LaravelData\Data;

final class PrintedDesignSettingData extends Data
{
    public function __construct(
        public bool $uses_supports
    ) {}
}
