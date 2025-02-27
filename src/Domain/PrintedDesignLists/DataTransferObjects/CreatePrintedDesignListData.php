<?php

namespace Domain\PrintedDesignLists\DataTransferObjects;

use Spatie\LaravelData\Data;

final class CreatePrintedDesignListData extends Data
{
    public function __construct(
        public string $title,
        public string $image_url
    ) {}
}
