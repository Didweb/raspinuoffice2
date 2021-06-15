<?php

declare(strict_types=1);

namespace RaspinuOffice\Backoffice\Products\Supplier\Application\Command;


use RaspinuOffice\Backoffice\Products\Supplier\Application\Services\DeleteSupplier;

final class DeleteSupplierCommandHandler
{
    private DeleteSupplier $deleteSupplier;

    public function __construct(DeleteSupplier $deleteSupplier)
    {
        $this->deleteSupplier = $deleteSupplier;
    }

    public function __invoke(DeleteSupplierCommand $command): void
    {
        $this->deleteSupplier->__invoke($command);
    }
}