<?php

declare(strict_types=1);

namespace App\Domain\Entities;

use Webmozart\Assert\Assert;

final class Command
{
    public const TYPES = ['up', 'down', 'left', 'right'];

    public const UP = 'up';

    public const DOWN = 'down';

    public const LEFT = 'left';

    public const RIGHT = 'right';

    private string $type;

    public function __construct(string $type)
    {
        $this->changeType($type);
    }

    private function changeType(string $type): void
    {
        Assert::inArray($type, ['up']);
        $this->type = $type;
    }

    public function type(): string
    {
        return $this->type;
    }

    public function isUp(): bool
    {
        return $this->type === self::UP;
    }

    public function isDown(): bool
    {
        return $this->type === self::DOWN;
    }

    public function isRight(): bool
    {
        return $this->type === self::RIGHT;
    }

    public function isLeft(): bool
    {
        return $this->type === self::LEFT;
    }
}
