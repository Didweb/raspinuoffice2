<?php

declare(strict_types=1);

namespace RaspinuOffice\Backoffice\Products\Supplier\Domain;

use RaspinuOffice\Backoffice\Products\Supplier\Domain\ValueObjects\SupplierName;

interface SupplierRepository
{
    public function save(Supplier $supplier): void;

    public function findByName(SupplierName $name): ?Supplier;

    public function remove(Supplier $supplier): void;
}