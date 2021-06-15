<?php

declare(strict_types=1);

namespace RaspinuOffice\Backoffice\Products\Supplier\Infrastructure\Response;


use RaspinuOffice\Backoffice\Products\Supplier\Domain\Supplier;
use RaspinuOffice\Shared\Domain\Paginated\Paginated;
use RaspinuOffice\Shared\Infrastructure\Paginated\PaginatedCollection;
use RaspinuOffice\Shared\Infrastructure\Paginated\PaginatedResponseDoctrine;

final class PaginatedSupplierResponseConverter
{
    private SupplierResponseConverter $supplierResponseConverter;

    public function __construct(SupplierResponseConverter $supplierResponseConverter)
    {
        $this->supplierResponseConverter = $supplierResponseConverter;
    }

    public function __invoke(PaginatedCollection $paginatedCollection, Paginated $paginated): PaginatedResponseDoctrine
    {
        $supplier = $paginatedCollection->map(
            function (Supplier $label) {
                return $this->supplierResponseConverter->__invoke($label);
            }
        );

        return PaginatedResponseDoctrine::create(
            $supplier,
            $paginated->pageSize(),
            $paginatedCollection->totalCollection(),
            $paginatedCollection->total(),
            $paginated->page()
        );
    }

}