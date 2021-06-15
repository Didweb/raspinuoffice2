<?php

declare(strict_types=1);

namespace RaspinuOffice\Api\Application\Controller\Products\Supplier\Request;


use InvalidArgumentException;

final class DeleteSupplierRequest
{
    private string $id;

    public function __construct(string $id)
    {
        $this->id = $id;
    }

    public function id(): string
    {
        return $this->id;
    }

    public static function fromContent(array $content): self
    {
        $content = $content['supplier'][0];

        if (!isset($content['id']))
        {
            throw new InvalidArgumentException('Field id is required');
        }

        return new self(
            $content['id']
        );
    }
}