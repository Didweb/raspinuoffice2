<?php

declare(strict_types=1);

namespace RaspinuOffice\Backoffice\Products\Genre\Application\Services;


use RaspinuOffice\Backoffice\Products\Genre\Domain\Exceptions\GenreThisNameAlreadyExist;
use RaspinuOffice\Backoffice\Products\Genre\Domain\Genre;
use RaspinuOffice\Backoffice\Products\Genre\Domain\GenreRepository;
use RaspinuOffice\Backoffice\Products\Genre\Domain\ValueObjects\GenreName;

final class ThisNameAlreadyExists
{
    private GenreRepository $repository;

    public function __construct(GenreRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(GenreName $name): bool
    {
        $thisNameAlreadyExists = $this->repository->findByName($name);

        if ($thisNameAlreadyExists !== null) {
            throw GenreThisNameAlreadyExist::ofName($name);
        }
        return false;
    }
}