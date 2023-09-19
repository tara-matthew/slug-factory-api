<?php

namespace App\DataTransferObjects;

use App\Models\PrintedDesign;

class FavouritePrintedDesignData
{
    public function __construct(
        public PrintedDesign $printedDesign,
//        public int $user_id,
    ) {
    }
}
