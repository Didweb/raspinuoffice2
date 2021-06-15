<?php

declare(strict_types=1);

namespace RaspinuOffice\Backoffice\Products\Supplier\Application\Services;


use RaspinuOffice\Backoffice\Products\Supplier\Domain\Exceptions\SupplierThisNameAlreadyExist;
use RaspinuOffice\Backoffice\Products\Supplier\Domain\SupplierRepository;
use RaspinuOffice\Backoffice\Products\Supplier\Domain\ValueObjects\SupplierName;

final class ThisNameAlreadyExists
{
    private SupplierRepository $repository;

    public function __construct(SupplierRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(SupplierName $name): bool
    {
        $thisNameAlreadyExists = $this->repository->findByName($name);

        if ($thisNameAlreadyExists !== null) {
            throw SupplierThisNameAlreadyExist::ofName($name);
        }
        return false;
    }
}