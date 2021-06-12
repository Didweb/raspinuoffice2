<?php

declare(strict_types=1);

namespace RaspinuOffice\Backoffice\Products\Genre\Infrastructure\Response;


use RaspinuOffice\Backoffice\Products\Genre\Domain\Genre;
use RaspinuOffice\Shared\Domain\Paginated\Paginated;
use RaspinuOffice\Shared\Infrastructure\Paginated\PaginatedCollection;
use RaspinuOffice\Shared\Infrastructure\Paginated\PaginatedResponseDoctrine;

final class PaginatedGenreResponseConverter
{
    private GenreResponseConverter $genreResponseConverter;

    public function __construct(GenreResponseConverter $genreResponseConverter)
    {
        $this->genreResponseConverter = $genreResponseConverter;
    }

    public function __invoke(PaginatedCollection $paginatedCollection, Paginated $paginated): PaginatedResponseDoctrine
    {
        $genres = $paginatedCollection->map(
            function (Genre $genre) {
                return $this->genreResponseConverter->__invoke($genre);
            }
        );

        return PaginatedResponseDoctrine::create(
            $genres,
            $paginated->pageSize(),
            $paginatedCollection->totalCollection(),
            $paginatedCollection->total(),
            $paginated->page()
        );
    }
}