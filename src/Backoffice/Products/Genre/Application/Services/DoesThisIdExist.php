<?php

declare(strict_types=1);

namespace RaspinuOffice\Backoffice\Products\Genre\Application\Services;


use RaspinuOffice\Backoffice\Products\Genre\Domain\Exceptions\GenreThisIdExists;
use RaspinuOffice\Backoffice\Products\Genre\Domain\Genre;
use RaspinuOffice\Backoffice\Products\Genre\Domain\GenreRepository;
use RaspinuOffice\Backoffice\Products\Genre\Domain\ValueObjects\GenreId;

final class DoesThisIdExist
{
    private GenreRepository $repository;

    public function __construct(GenreRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(GenreId $id): ?Genre
    {
        $genre = $this->repository->findBy($id);

        if($genre === null) {
            throw GenreThisIdExists::ofId($id);
        }
        return $genre;
    }
}