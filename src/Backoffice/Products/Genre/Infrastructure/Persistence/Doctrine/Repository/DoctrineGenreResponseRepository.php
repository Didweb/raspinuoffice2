<?php

declare(strict_types=1);

namespace RaspinuOffice\Backoffice\Products\Genre\Infrastructure\Persistence\Doctrine\Repository;



use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use RaspinuOffice\Backoffice\Products\Genre\Domain\Genre;
use RaspinuOffice\Backoffice\Products\Genre\Domain\GenreResponseRepository;
use RaspinuOffice\Backoffice\Products\Genre\Infrastructure\Response\PaginatedGenreResponseConverter;
use RaspinuOffice\Shared\Infrastructure\Paginated\Paginated;
use RaspinuOffice\Shared\Infrastructure\Paginated\PaginatedCollection;
use RaspinuOffice\Shared\Infrastructure\Paginated\PaginatedResponse;

final class DoctrineGenreResponseRepository implements GenreResponseRepository
{
    private EntityManagerInterface $em;
    private EntityRepository $repository;
    private PaginatedGenreResponseConverter $paginatedGenreResponseConverter;

    public function __construct(EntityManagerInterface $em,
        PaginatedGenreResponseConverter $paginatedGenreResponseConverter)
    {
        $this->em = $em;
        /** @var EntityRepository $repository */
        $repository = $this->em->getRepository(Genre::class);
        $this->repository = $repository;
        $this->paginatedGenreResponseConverter = $paginatedGenreResponseConverter;
    }

    public function allGenre(Paginated $paginated): PaginatedResponse
    {

        $query = $this
            ->repository
            ->createQueryBuilder('g');

        $query = $query->getQuery();

        return $this->paginatedGenreResponseConverter->__invoke(
            PaginatedCollection::createFromQuery($query, $paginated),
            $paginated
        );
    }

}