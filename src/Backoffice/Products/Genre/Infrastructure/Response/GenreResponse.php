<?php

declare(strict_types=1);

namespace RaspinuOffice\Backoffice\Products\Genre\Infrastructure\Response;

use RaspinuOffice\Shared\Domain\Bus\Query\Response;

final class GenreResponse  extends Response
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
}