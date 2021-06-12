<?php

declare(strict_types=1);

namespace RaspinuOffice\Shared\Infrastructure\Symfony;

use RaspinuOffice\Shared\Domain\Bus\Command\Command;
use RaspinuOffice\Shared\Domain\Bus\Command\CommandBus;
use RaspinuOffice\Shared\Domain\Bus\Command\CommandBusInterface;

abstract class ApiController
{
    private CommandBusInterface $commandBusInterface;

    public function __construct(CommandBus $commandBus)
    {
        $this->commandBusInterface = $commandBus;
    }

    abstract protected function exceptions(): array;

    protected function dispatch(Command $command): void
    {
        $this->commandBusInterface->dispatch($command);
    }
}