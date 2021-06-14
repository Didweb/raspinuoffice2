<?php

declare(strict_types=1);

namespace RaspinuOffice\Backoffice\Products\Genre\Infrastructure\Persistence\Doctrine\Repository;


use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use RaspinuOffice\Backoffice\Products\Genre\Domain\Genre;
use RaspinuOffice\Backoffice\Products\Genre\Domain\GenreRepository;
use RaspinuOffice\Backoffice\Products\Genre\Domain\ValueObjects\GenreId;
use RaspinuOffice\Backoffice\Products\Genre\Domain\ValueObjects\GenreName;

final class DoctrineGenreRepository implements GenreRepository
{
    private EntityManagerInterface $em;
    private EntityRepository $repository;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->em = $manager;
        /** @var EntityRepository $repository */
        $repository = $this->em->getRepository(Genre::class);
        $this->repository = $repository;
    }

    public function save(Genre $genre): void
    {
        $this->em->persist($genre);
    }

    public function findBy(GenreId $id): ?Genre
    {
        return $this->repository->find($id);
    }

    public function findByName(GenreName $name): ?Genre
    {
        return $this->repository->findOneBy(['name' => $name]);
    }

    public function remove(Genre $genre): void
    {
        $this->em->remove($genre);
        $this->em->flush();
    }
}