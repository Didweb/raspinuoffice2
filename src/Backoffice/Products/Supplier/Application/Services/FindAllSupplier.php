<?php

declare(strict_types=1);

namespace RaspinuOffice\Backoffice\Products\Supplier\Application\Services;


use RaspinuOffice\Backoffice\Products\Supplier\Domain\SupplierResponseRepository;
use RaspinuOffice\Shared\Domain\Paginated\Paginated;
use RaspinuOffice\Shared\Domain\Paginated\PaginatedResponse;

final class FindAllSupplier
{
    private SupplierResponseRepository $repository;

    public function __construct(SupplierResponseRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(Paginated $paginated): PaginatedResponse
    {
        return $this->repository->allSupplier($paginated);
    }

}