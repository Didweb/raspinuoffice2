<?php

declare(strict_types=1);

namespace RaspinuOffice\Backoffice\Products\Supplier\Infrastructure\Persistence\Doctrine\Repository;


use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use RaspinuOffice\Backoffice\Products\Supplier\Domain\Supplier;
use RaspinuOffice\Backoffice\Products\Supplier\Domain\SupplierResponseRepository;
use RaspinuOffice\Backoffice\Products\Supplier\Infrastructure\Response\PaginatedSupplierResponseConverter;
use RaspinuOffice\Shared\Domain\Paginated\Paginated;
use RaspinuOffice\Shared\Domain\Paginated\PaginatedResponse;
use RaspinuOffice\Shared\Infrastructure\Paginated\PaginatedCollection;

final class DoctrineSupplierResponseRepository implements SupplierResponseRepository
{
    private EntityManagerInterface $em;
    private EntityRepository $repository;
    private PaginatedSupplierResponseConverter $paginatedSupplierResponseConverter;

    public function __construct(EntityManagerInterface $em,
        PaginatedSupplierResponseConverter $paginatedSupplierResponseConverter)
    {
        $this->em = $em;
        /** @var EntityRepository $repository */
        $repository = $this->em->getRepository(Supplier::class);
        $this->repository = $repository;
        $this->paginatedSupplierResponseConverter = $paginatedSupplierResponseConverter;
    }

    public function allSupplier(Paginated $paginated): PaginatedResponse
    {
        $query = $this->repository->createQueryBuilder('s');

        $query = $query->getQuery();

        return $this->paginatedSupplierResponseConverter->__invoke(
            PaginatedCollection::createFromQuery($query, $paginated),
            $paginated
        );
    }
}