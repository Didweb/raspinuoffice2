<?php

declare(strict_types=1);

namespace RaspinuOffice\Api\Application\Controller\Products\Genre\Request;

use InvalidArgumentException;

final class CreateGenreRequest
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

    public static function fromContent(array $content): self
    {

        $content = $content['genre'][0];

        if (!isset($content['name'])
        ) {
            throw new InvalidArgumentException('Field name is required');
        }

        return new self(
            $content['id'],
            $content['name']
        );
    }
}