<?php

namespace Domain\PrintedDesigns\Events;

use Domain\PrintedDesigns\Models\PrintedDesign;
use Domain\Users\Models\User;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PrintedDesignFavourited
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(public readonly PrintedDesign $printedDesign, public readonly User $user)
    {
        //
    }
}
