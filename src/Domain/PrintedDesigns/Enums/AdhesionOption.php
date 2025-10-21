<?php

declare(strict_types=1);

namespace Domain\PrintedDesigns\Enums;

enum AdhesionOption: string
{
    case Skirt = 'skirt';
    case Brim = 'brim';
    case Raft = 'raft';
}
