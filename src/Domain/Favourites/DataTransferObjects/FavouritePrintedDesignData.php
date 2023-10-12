<?php

namespace Domain\Favourites\DataTransferObjects;

use Domain\PrintedDesigns\Models\PrintedDesign;
use Spatie\LaravelData\Data;

class FavouritePrintedDesignData extends Data
{
    public function __construct(
        public PrintedDesign $printedDesign,
//        public int $user_id,
    ) {
    }
}
