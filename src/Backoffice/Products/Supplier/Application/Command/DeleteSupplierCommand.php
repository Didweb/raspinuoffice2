<?php

declare(strict_types=1);

namespace RaspinuOffice\Backoffice\Products\Supplier\Application\Command;


use RaspinuOffice\Shared\Domain\Bus\Command\Command;

final class DeleteSupplierCommand extends Command
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

    public function _toArray(): array
    {
        return [
            'id' => $this->id
        ];
    }
}