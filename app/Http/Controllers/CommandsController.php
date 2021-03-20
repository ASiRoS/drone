<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Domain\Entities\Drone;
use App\Domain\Entities\Field;
use App\Domain\Entities\Position;
use App\Http\Requests\CommandRequest;
use App\Services\PositionRepository;
use Psr\EventDispatcher\EventDispatcherInterface;

final class CommandsController
{
    private PositionRepository $position;
    private EventDispatcherInterface $dispatcher;

    public function __construct(PositionRepository $position, EventDispatcherInterface $dispatcher)
    {
        $this->position = $position;
        $this->dispatcher = $dispatcher;
    }

    public function index(CommandRequest $commandRequest): void
    {
        $data = $commandRequest->validated();

        $startPosition = null;

        if ($commandRequest->hasStartPosition()) {
            $startPosition = new Position(
                $data['start_position']['x'],
                $data['start_position']['y']
            );
        }

        $startPosition = $this->position->getStartPosition($startPosition);

        $field = new Field();
        $drone = new Drone($field, $startPosition);

        $drone->move($data['commands']);

        foreach ($drone->movements() as $movement) {
            $this->dispatcher->dispatch($movement);
        }
    }
}
