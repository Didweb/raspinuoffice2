<?php

declare(strict_types=1);

namespace RaspinuOffice\Backoffice\Products\Genre\Application\Services;


use RaspinuOffice\Backoffice\Products\Genre\Application\Command\CreateGenreCommand;
use RaspinuOffice\Backoffice\Products\Genre\Domain\Genre;
use RaspinuOffice\Backoffice\Products\Genre\Domain\GenreRepository;
use RaspinuOffice\Backoffice\Products\Genre\Domain\ValueObjects\GenreId;
use RaspinuOffice\Backoffice\Products\Genre\Domain\ValueObjects\GenreName;

class CreateGenre
{
    private GenreRepository $repository;
    private ThisNameAlreadyExists $thisNameAlreadyExists;

    public function __construct(GenreRepository $repository, ThisNameAlreadyExists $thisNameAlreadyExists)
    {
        $this->repository = $repository;
        $this->thisNameAlreadyExists = $thisNameAlreadyExists;
    }

    public function __invoke(CreateGenreCommand $command): void
    {
        $genreName = new GenreName($command->name());

        $this->thisNameAlreadyExists->__invoke($genreName);

        $genre = new Genre(
            GenreId::create($command->id()),
            $genreName
        );

        $this->repository->save($genre);
    }

}