<?php

declare(strict_types=1);

namespace RaspinuOffice\Backoffice\Products\Genre\Application\Services;

use RaspinuOffice\Backoffice\Products\Genre\Domain\Genre;
use RaspinuOffice\Backoffice\Products\Genre\Domain\GenreRepository;
use RaspinuOffice\Backoffice\Products\Genre\Domain\ValueObjects\GenreId;

final class FinderGenre
{
    private GenreRepository $repository;

    public function __construct(GenreRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(GenreId $id): ?Genre
    {
        return  $this->repository->findBy($id);
    }
}