<?php

declare(strict_types=1);

namespace RaspinuOffice\Backoffice\Products\Style\Infrastructure\Persistence\Doctrine\Repository;


use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use RaspinuOffice\Backoffice\Products\Style\Domain\Style;
use RaspinuOffice\Backoffice\Products\Style\Domain\StyleResponseRepository;
use RaspinuOffice\Backoffice\Products\Style\Infrastructure\Response\PaginatedStyleResponseConverter;
use RaspinuOffice\Shared\Domain\Paginated\Paginated;
use RaspinuOffice\Shared\Domain\Paginated\PaginatedResponse;
use RaspinuOffice\Shared\Infrastructure\Paginated\PaginatedCollection;

final class DoctrineStyleResponseRepository implements StyleResponseRepository
{
    private EntityManagerInterface $em;
    private EntityRepository $repository;
    private PaginatedStyleResponseConverter $paginatedStyleResponseConverter;

    public function __construct(EntityManagerInterface $em,
        PaginatedStyleResponseConverter $paginatedStyleResponseConverter)
    {
        $this->em = $em;
        /** @var EntityRepository $repository */
        $repository = $this->em->getRepository(Style::class);
        $this->repository = $repository;
        $this->paginatedStyleResponseConverter = $paginatedStyleResponseConverter;
    }
    public function allStyle(Paginated $paginated): PaginatedResponse
    {
        $query = $this->repository->createQueryBuilder('l');

        $query = $query->getQuery();

        return $this->paginatedStyleResponseConverter->__invoke(
            PaginatedCollection::createFromQuery($query, $paginated),
            $paginated
        );
    }
}