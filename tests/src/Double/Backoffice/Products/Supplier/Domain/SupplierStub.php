<?php

declare(strict_types=1);

namespace RaspinuOffice\Tests\Double\Backoffice\Products\Supplier\Domain;


use RaspinuOffice\Backoffice\Products\Supplier\Domain\Supplier;
use RaspinuOffice\Backoffice\Products\Supplier\Domain\ValueObjects\SupplierId;
use RaspinuOffice\Backoffice\Products\Supplier\Domain\ValueObjects\SupplierName;
use RaspinuOffice\Tests\Double\Backoffice\Products\Supplier\Domain\ValueObjects\SupplierIdStub;
use RaspinuOffice\Tests\Double\Backoffice\Products\Supplier\Domain\ValueObjects\SupplierNameStub;

final class SupplierStub
{
    public static function random(): Supplier
    {
        return new Supplier(
            SupplierIdStub::random(),
            SupplierNameStub::random()
        );
    }

    public static function create(SupplierId $id, SupplierName $name): Supplier
    {
        return new Supplier($id,$name);
    }
}