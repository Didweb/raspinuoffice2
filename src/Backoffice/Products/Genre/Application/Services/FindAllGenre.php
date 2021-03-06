<?php

declare(strict_types=1);

namespace RaspinuOffice\Backoffice\Products\Genre\Application\Services;

use RaspinuOffice\Backoffice\Products\Genre\Domain\GenreResponseRepository;
use RaspinuOffice\Shared\Domain\Paginated\Paginated;
use RaspinuOffice\Shared\Domain\Paginated\PaginatedResponse;

class FindAllGenre
{
    private GenreResponseRepository $repository;

    public function __construct(GenreResponseRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(Paginated $paginated): PaginatedResponse
    {
        return  $this->repository->allGenre($paginated);
    }
}