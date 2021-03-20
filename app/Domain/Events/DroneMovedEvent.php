<?php

declare(strict_types=1);

namespace App\Domain\Events;

use App\Domain\Entities\Position;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

final class DroneMovedEvent implements ShouldQueue
{
    use Dispatchable;

    public Position $position;

    public function __construct(Position $position)
    {
        $this->position = $position;
    }
}
