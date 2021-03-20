<?php

declare(strict_types=1);

namespace App\Domain\Listeners;

use App\Domain\Events\DroneMovedEvent;
use Psr\Log\LoggerInterface;

final class LogDroneMovement
{
    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function handle(DroneMovedEvent $event): void
    {
        $position = $event->position;

        $this->logger->info(
            sprintf('%sx%s', $position->getX(), $position->getY())
        );
    }
}
