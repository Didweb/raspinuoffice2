<?php

declare(strict_types=1);

namespace RaspinuOffice\Tests\Double\Backoffice\Products\Supplier\Domain\ValueObjects;


use RaspinuOffice\Backoffice\Products\Supplier\Domain\ValueObjects\SupplierId;
use RaspinuOffice\Shared\Infrastructure\Helper\Faker;

final class SupplierIdStub
{
    public static function random(): SupplierId
    {
        return SupplierId::create(Faker::uuid());
    }

    public static function create(string $id): SupplierId
    {
        return SupplierId::create($id);
    }
}