<?php

namespace Domain\PrintedDesigns\DataTransferObjects;

use Domain\Images\DataTransferObjects\ImageData;
use Domain\PrintedDesignSettings\DataTransferObjects\PrintedDesignSettingData;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

final class CreatePrintedDesignData extends Data
{
    public function __construct(
        public ?int $id,
        public string $title,
        public string $description,
        public ?int $filament_brand_id,
        public ?int $filament_colour_id,
        public int $filament_material_id,
        #[DataCollectionOf(ImageData::class)]
        public DataCollection $images,
        public ?bool $uses_supports, // TODO use PrintedDesignSettingData
        public string $adhesion_type,
        public bool $is_favourite = false,
    ) {}
}
