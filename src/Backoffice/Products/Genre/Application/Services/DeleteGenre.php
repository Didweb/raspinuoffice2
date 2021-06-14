<?php

declare(strict_types=1);

namespace RaspinuOffice\Backoffice\Products\Genre\Application\Services;


use RaspinuOffice\Backoffice\Products\Genre\Application\Command\DeleteGenreCommand;
use RaspinuOffice\Backoffice\Products\Genre\Domain\Exceptions\GenreThisIdExists;
use RaspinuOffice\Backoffice\Products\Genre\Domain\Genre;
use RaspinuOffice\Backoffice\Products\Genre\Domain\GenreRepository;
use RaspinuOffice\Backoffice\Products\Genre\Domain\ValueObjects\GenreId;
use RaspinuOffice\Backoffice\Products\Genre\Domain\ValueObjects\GenreName;

final class DeleteGenre
{
    private GenreRepository $repository;
    private DoesThisIdExist $doesThisIdExist;

    public function __construct(GenreRepository $repository, DoesThisIdExist $doesThisIdExist)
    {
        $this->repository = $repository;
        $this->doesThisIdExist = $doesThisIdExist;
    }

    public function __invoke(DeleteGenreCommand $command): void
    {
        $genreId = GenreId::create($command->id());

        $genre = $this->doesThisIdExist->__invoke($genreId);

        if($genre) {
            $this->repository->remove($genre);
        }

    }

}