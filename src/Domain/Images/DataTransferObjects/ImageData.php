<?php

namespace Domain\Images\DataTransferObjects;

use Illuminate\Http\UploadedFile;
use Spatie\LaravelData\Data;

class ImageData extends Data
{
    public function __construct(
        public ?int $id,
        public UploadedFile $image,
        //        public bool $is_cover_image,
        public ?int $printed_design_id,
        public ?int $user_id // TODO do I need this?
    ) {}

    // TODO add fromModel method for the relationship
    //    public static function fromModel(Image $image): self
    //    {
    //        return new self(
    //            $image->url,
    //            $image->is_cover_image,
    //            $image->printed_design_id,
    //            $image->user_id,
    //        );
    //    }
}
