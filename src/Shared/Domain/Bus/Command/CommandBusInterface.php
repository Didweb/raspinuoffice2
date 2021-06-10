<?php

declare(strict_types=1);

namespace RaspinuOffice\Shared\Domain\Bus\Command;


interface CommandBusInterface
{
    public function dispatch(Command $command): void;
}