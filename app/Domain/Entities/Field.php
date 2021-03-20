<?php

declare(strict_types=1);

namespace App\Domain\Entities;

final class Field
{
    private int $size;

    public function __construct(int $size = 100)
    {
        $this->size = $size;
    }

    public function getSize(): int
    {
        return $this->size * $this->size;
    }

    public function isValidPosition(Position $position): bool
    {
        return $this->getSize() > $position->getBiggest();
    }
}
