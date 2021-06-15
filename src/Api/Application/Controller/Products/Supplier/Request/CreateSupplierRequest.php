<?php

declare(strict_types=1);

namespace RaspinuOffice\Api\Application\Controller\Products\Supplier\Request;


use InvalidArgumentException;

final class CreateSupplierRequest
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
        $content = $content['supplier'][0];

        if (!isset($content['id'])
            || !isset($content['name'])) {
            throw new InvalidArgumentException('Field id and name  is required');
        }

        return new self(
            $content['id'],
            $content['name']
        );
    }
}