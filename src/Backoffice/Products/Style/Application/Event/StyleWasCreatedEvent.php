<?php

declare(strict_types=1);

namespace RaspinuOffice\Backoffice\Products\Style\Application\Event;

use RaspinuOffice\Shared\Domain\Bus\Event\Event;

final class StyleWasCreatedEvent implements Event
{
    private string $id;
    private string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function name(): string
    {
        return $this->name;
    }
}