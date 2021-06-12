<?php

declare(strict_types=1);

namespace RaspinuOffice\Backoffice\Products\Genre\Infrastructure\Response;


use RaspinuOffice\Backoffice\Products\Genre\Domain\Genre;
use RaspinuOffice\Shared\Infrastructure\Paginated\Paginated;
use RaspinuOffice\Shared\Infrastructure\Paginated\PaginatedCollection;
use RaspinuOffice\Shared\Infrastructure\Paginated\PaginatedResponse;

final class PaginatedGenreResponseConverter
{
    private GenreResponseConverter $genreResponseConverter;

    public function __construct(GenreResponseConverter $genreResponseConverter)
    {
        $this->genreResponseConverter = $genreResponseConverter;
    }

    public function invoke(PaginatedCollection $paginatedCollection, Paginated $paginated): PaginatedResponse
    {
        $genres = $paginatedCollection->map(
            function (Genre $genre) {
                return $this->genreResponseConverter->__invoke($genre);
            }
        );

        return PaginatedResponse::create(
            $genres,
            $paginated->pageSize(),
            $paginatedCollection->totalCollection(),
            $paginatedCollection->total(),
            $paginated->page()
        );
    }
}