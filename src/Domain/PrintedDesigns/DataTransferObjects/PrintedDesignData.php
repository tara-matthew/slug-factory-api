<?php

namespace Domain\PrintedDesigns\DataTransferObjects;

use Spatie\LaravelData\Data;

class PrintedDesignData extends Data
{
    public function __construct(
        public string $title,
        public string $description,
        public int $user_id,
        public int $filament_brand_id,
        public int $filament_colour_id,
        public ?array $images = [] // TODO could this be a value object?
    ) {
    }
}
