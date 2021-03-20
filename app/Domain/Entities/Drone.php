<?php

declare(strict_types=1);

namespace App\Domain\Entities;

use App\Domain\Events\DroneMovedEvent;
use RuntimeException;

final class Drone
{
    private Field $currentField;
    private Position $currentPosition;

    /** @var DroneMovedEvent[] */
    private array $movements = [];

    public function __construct(Field $field, ?Position $position)
    {
        $this->currentField = $field;
        $this->currentPosition = $position ?? new Position(0, 0);
    }

    public function move(Commands $commands): void
    {
        foreach ($commands as $command) {
            $newPosition = $this->currentPosition->move($command->type());

            $this->movements[] = new DroneMovedEvent($newPosition);
        }

        if (!$this->currentField->isValidPosition($newPosition)) {
            throw new RuntimeException('Drone can not pass out of the field.');
        }

        $this->currentPosition = $newPosition;
    }

    public function currentPosition(): Position
    {
        return $this->currentPosition;
    }

    /**
     * @return DroneMovedEvent[]
     */
    public function movements(): array
    {
        return $this->movements;
    }
}
