<?php

namespace Domain\PrintedDesigns\DataTransferObjects;

use Domain\Images\DataTransferObjects\ImageData;
use Domain\PrintedDesigns\Models\PrintedDesign;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\Exceptions\PaginatedCollectionIsAlwaysWrapped;

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
        public bool $is_favourite = false
    ) {}

    /**
     * @throws PaginatedCollectionIsAlwaysWrapped
     */
    public static function fromModel(PrintedDesign $printedDesign): self
    {
        return new self(
            $printedDesign->id,
            $printedDesign->title,
            $printedDesign->description,
            $printedDesign->user_id,
            $printedDesign->filament_brand_id,
            $printedDesign->filament_colour_id,
            ImageData::collection($printedDesign->images)->withoutWrapping(),
            (bool) $printedDesign->favourites->filter(function ($favourite) {
                return $favourite->user_id === auth()->id();
            })->first(),
        );
    }

    public static function fromRequest(array $request)
    {
        //        dd('here', $request['title']);
    }
}
