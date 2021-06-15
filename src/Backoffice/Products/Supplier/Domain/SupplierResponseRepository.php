<?php

declare(strict_types=1);

namespace RaspinuOffice\Backoffice\Products\Supplier\Domain;


use RaspinuOffice\Shared\Domain\Paginated\Paginated;
use RaspinuOffice\Shared\Domain\Paginated\PaginatedResponse;

interface SupplierResponseRepository
{
    public function allSupplier(Paginated $paginated): PaginatedResponse;
}