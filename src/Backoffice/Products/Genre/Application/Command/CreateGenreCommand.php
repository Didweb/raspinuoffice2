<?php

declare(strict_types=1);

namespace RaspinuOffice\Backoffice\Products\Genre\Application\Command;


use RaspinuOffice\Shared\Domain\Bus\Command\Command;

final class CreateGenreCommand extends Command
{
    private string $id;
    private string $name;

    public function __construct(string $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public function id(): string
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function _toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
        ];
    }
}