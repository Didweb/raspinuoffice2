<?php

declare(strict_types=1);

namespace RaspinuOffice\Tests\Double\Backoffice\Products\Supplier\Domain\ValueObjects;


use RaspinuOffice\Backoffice\Products\Supplier\Domain\ValueObjects\SupplierName;
use RaspinuOffice\Shared\Infrastructure\Helper\Faker;

final class SupplierNameStub
{
    public static function random(): SupplierName
    {
        return new SupplierName(Faker::word());
    }

    public static function create(string $name): SupplierName
    {
        return new SupplierName($name);
    }
}