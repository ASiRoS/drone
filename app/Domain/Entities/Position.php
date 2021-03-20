<?php

declare(strict_types=1);

namespace App\Domain\Entities;

final class Position
{
    private int $x;
    private int $y;

    public function __construct(int $x, int $y)
    {
        $this->x = $x;
        $this->y = $y;
    }

    public function getX(): int
    {
        return $this->x;
    }

    public function getY(): int
    {
        return $this->y;
    }

    public function getBiggest(): int
    {
        return max($this->x, $this->y);
    }

    public function move(Command $command): self
    {
        $x = $this->x;
        $y = $this->y;

        if ($command->isUp()) {
            $y++;
        } elseif($command->isDown()) {
            $y--;
        } elseif($command->isLeft()) {
            $x--;
        } elseif($command->isRight()) {
            $x++;
        }

        return new self($x, $y);
    }
}
