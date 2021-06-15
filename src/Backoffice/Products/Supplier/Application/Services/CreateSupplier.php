<?php

declare(strict_types=1);

namespace RaspinuOffice\Backoffice\Products\Supplier\Application\Services;


use RaspinuOffice\Backoffice\Products\Supplier\Application\Command\CreateSupplierCommand;
use RaspinuOffice\Backoffice\Products\Supplier\Domain\Supplier;
use RaspinuOffice\Backoffice\Products\Supplier\Domain\SupplierRepository;
use RaspinuOffice\Backoffice\Products\Supplier\Domain\ValueObjects\SupplierId;
use RaspinuOffice\Backoffice\Products\Supplier\Domain\ValueObjects\SupplierName;

final class CreateSupplier
{
    private SupplierRepository $repository;
    private ThisNameAlreadyExists $thisNameAlreadyExists;

    public function __construct(SupplierRepository $repository, ThisNameAlreadyExists $thisNameAlreadyExists)
    {
        $this->repository = $repository;
        $this->thisNameAlreadyExists = $thisNameAlreadyExists;
    }

    public function __invoke(CreateSupplierCommand $command): void
    {
        $supplierName = new SupplierName($command->name());

        $this->thisNameAlreadyExists->__invoke($supplierName);

        $supplier = new Supplier(
            SupplierId::create($command->id()),
            $supplierName
        );

        $this->repository->save($supplier);
    }
}