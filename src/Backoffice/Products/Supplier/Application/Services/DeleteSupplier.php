<?php

declare(strict_types=1);

namespace RaspinuOffice\Backoffice\Products\Supplier\Application\Services;


use RaspinuOffice\Backoffice\Products\Supplier\Application\Command\DeleteSupplierCommand;
use RaspinuOffice\Backoffice\Products\Supplier\Domain\SupplierRepository;
use RaspinuOffice\Backoffice\Products\Supplier\Domain\ValueObjects\SupplierId;

final class DeleteSupplier
{
    private SupplierRepository $repository;
    private DoesThisIdExist $doesThisIdExist;

    public function __construct(SupplierRepository $repository, DoesThisIdExist $doesThisIdExist)
    {
        $this->repository = $repository;
        $this->doesThisIdExist = $doesThisIdExist;
    }

    public function __invoke(DeleteSupplierCommand $command): void
    {
        $supplierId = SupplierId::create($command->id());

        $supplier = $this->doesThisIdExist->__invoke($supplierId);

        if($supplier) {
            $this->repository->remove($supplier);
        }
    }
}