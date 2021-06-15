<?php

declare(strict_types=1);

namespace RaspinuOffice\Backoffice\Products\Supplier\Application\Services;


use RaspinuOffice\Backoffice\Products\Supplier\Domain\Exceptions\SupplierThisIdExists;
use RaspinuOffice\Backoffice\Products\Supplier\Domain\Supplier;
use RaspinuOffice\Backoffice\Products\Supplier\Domain\SupplierRepository;
use RaspinuOffice\Backoffice\Products\Supplier\Domain\ValueObjects\SupplierId;

final class DoesThisIdExist
{
    private SupplierRepository $repository;

    public function __construct(SupplierRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(SupplierId $id): ?Supplier
    {
        $supplier = $this->repository->findBy($id);

        if($supplier === null) {
            throw SupplierThisIdExists::ofId($id);
        }
        return $supplier;
    }
}