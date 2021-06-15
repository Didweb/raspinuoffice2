<?php

declare(strict_types=1);

namespace RaspinuOffice\Backoffice\Products\Supplier\Application\Command;


use RaspinuOffice\Backoffice\Products\Supplier\Application\Services\CreateSupplier;

final class CreateSupplierCommandHandler
{
    private CreateSupplier $createSupplier;

    public function __construct(CreateSupplier $createSupplier)
    {
        $this->createSupplier = $createSupplier;
    }

    public function __invoke(CreateSupplierCommand $command): void
    {
        $this->createSupplier->__invoke($command);
    }

}