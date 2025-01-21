<?php

namespace Domain\PrintedDesigns\Events;

use Domain\PrintedDesigns\Models\PrintedDesign;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PrintedDesignUploaded
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(public readonly PrintedDesign $printedDesign) {}
}
