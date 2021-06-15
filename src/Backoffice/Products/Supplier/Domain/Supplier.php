<?php

declare(strict_types=1);

namespace RaspinuOffice\Backoffice\Products\Supplier\Domain;


use RaspinuOffice\Backoffice\Products\Supplier\Domain\ValueObjects\SupplierId;
use RaspinuOffice\Backoffice\Products\Supplier\Domain\ValueObjects\SupplierName;

final class Supplier
{
    private SupplierId $id;
    private SupplierName $name;

    public function __construct(SupplierId $id, SupplierName $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public function id(): SupplierId
    {
        return $this->id;
    }

    public function name(): SupplierName
    {
        return $this->name;
    }
}