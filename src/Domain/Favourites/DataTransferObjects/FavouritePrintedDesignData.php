<?php

namespace Domain\Favourites\DataTransferObjects;

use Domain\PrintedDesigns\Models\PrintedDesign;

class FavouritePrintedDesignData
{
    public function __construct(
        public PrintedDesign $printedDesign,
//        public int $user_id,
    ) {
    }
}
