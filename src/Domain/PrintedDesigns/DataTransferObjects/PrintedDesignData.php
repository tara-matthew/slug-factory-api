<?php

namespace Domain\PrintedDesigns\DataTransferObjects;

class PrintedDesignData
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
