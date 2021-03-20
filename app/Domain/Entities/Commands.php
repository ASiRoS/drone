<?php

declare(strict_types=1);

namespace App\Domain\Entities;

final class Commands implements \Iterator
{
    private array $commands = [];

    private int $position = 0;

    public function __construct(array $commands)
    {
        foreach ($commands as $command) {
            $this->commands[] = new Command($command);
        }
    }

    public function current()
    {
        return $this->commands[$this->position];
    }

    public function next(): void
    {
        $this->commands[++$this->position];
    }

    public function key()
    {
        return $this->position;
    }

    public function valid(): bool
    {
        return isset($this->commands[$this->position]);
    }

    public function rewind(): void
    {
        $this->position = 0;
    }
}
