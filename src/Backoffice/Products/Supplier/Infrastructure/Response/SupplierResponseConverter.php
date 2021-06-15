<?php

declare(strict_types=1);

namespace RaspinuOffice\Backoffice\Products\Supplier\Infrastructure\Response;


use RaspinuOffice\Backoffice\Products\Supplier\Domain\Supplier;

final class SupplierResponseConverter
{
    public function __invoke(Supplier $genre): SupplierResponse
    {
        return new SupplierResponse(
            (string)$genre->id(),
            (string)$genre->name()
        );
    }
}