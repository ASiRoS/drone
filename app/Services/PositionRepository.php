<?php

declare(strict_types=1);

namespace App\Services;

use App\Domain\Entities\Position;
use Illuminate\Support\Facades\Cache;

final class PositionRepository
{
    public const CURRENT_POSITION = 'current_position';

    public function getStartPosition(?Position $newPosition): Position
    {
        if ($newPosition) {
            return $newPosition;
        }

        $position = Cache::get(self::CURRENT_POSITION);

        if ($position) {
            return new Position($position['x'], $position['y']);
        }

        return new Position(0, 0);
    }
}
