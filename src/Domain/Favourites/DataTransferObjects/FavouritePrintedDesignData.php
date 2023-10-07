<?php

namespace Domain\Favourites\DataTransferObjects;

use Domain\Favourites\PrintedDesign;

class FavouritePrintedDesignData
{
    public function __construct(
        public PrintedDesign $printedDesign,
//        public int $user_id,
    ) {
    }
}
