<?php

namespace Domain\PrintedDesignSettings\DataTransferObjects;

use Spatie\LaravelData\Data;

final class PrintedDesignSettingData extends Data
{
    public function __construct(
        public bool $uses_supports
    ) {}
}
