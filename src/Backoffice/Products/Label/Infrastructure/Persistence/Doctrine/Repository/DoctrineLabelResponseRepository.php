<?php

declare(strict_types=1);

namespace RaspinuOffice\Backoffice\Products\Label\Infrastructure\Persistence\Doctrine\Repository;


use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use RaspinuOffice\Backoffice\Products\Label\Domain\Label;
use RaspinuOffice\Backoffice\Products\Label\Domain\LabelResponseRepository;
use RaspinuOffice\Backoffice\Products\Label\Infrastructure\Response\PaginatedLabelResponseConverter;
use RaspinuOffice\Shared\Domain\Paginated\Paginated;
use RaspinuOffice\Shared\Domain\Paginated\PaginatedResponse;
use RaspinuOffice\Shared\Infrastructure\Paginated\PaginatedCollection;

final class DoctrineLabelResponseRepository implements LabelResponseRepository
{
    private EntityManagerInterface $em;
    private EntityRepository $repository;
    private PaginatedLabelResponseConverter $paginatedLabelResponseConverter;

    public function __construct(EntityManagerInterface $em,
        PaginatedLabelResponseConverter $paginatedLabelResponseConverter)
    {
        $this->em = $em;
        /** @var EntityRepository $repository */
        $repository = $this->em->getRepository(Label::class);
        $this->repository = $repository;
        $this->paginatedLabelResponseConverter = $paginatedLabelResponseConverter;
    }
    public function allLabel(Paginated $paginated): PaginatedResponse
    {
        $query = $this->repository->createQueryBuilder('l');

        $query = $query->getQuery();

        return $this->paginatedLabelResponseConverter->__invoke(
            PaginatedCollection::createFromQuery($query, $paginated),
            $paginated
        );
    }
}