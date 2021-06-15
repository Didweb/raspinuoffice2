<?php

declare(strict_types=1);

namespace RaspinuOffice\Backoffice\Products\Supplier\Application\Query;


use RaspinuOffice\Backoffice\Products\Supplier\Application\Services\FindAllSupplier;
use RaspinuOffice\Backoffice\Products\Supplier\Domain\SupplierResponseRepository;
use RaspinuOffice\Shared\Domain\Paginated\Paginated;
use RaspinuOffice\Shared\Domain\Paginated\PaginatedResponse;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final class AllSupplierQueryHandler implements MessageHandlerInterface
{
    private SupplierResponseRepository $repository;
    private FindAllSupplier $findAllSupplier;

    public function __construct(SupplierResponseRepository $repository, FindAllSupplier $findAllSupplier)
    {
        $this->repository = $repository;
        $this->findAllSupplier = $findAllSupplier;
    }

    public function __invoke(AllSupplierQuery $query): PaginatedResponse
    {
        $paginated = Paginated::create($query->page(), $query->pageSize());

        return  $this->findAllSupplier->__invoke($paginated);
    }

}