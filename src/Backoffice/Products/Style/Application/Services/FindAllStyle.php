<?php

declare(strict_types=1);

namespace RaspinuOffice\Backoffice\Products\Style\Application\Services;


use RaspinuOffice\Backoffice\Products\Style\Domain\StyleResponseRepository;
use RaspinuOffice\Shared\Domain\Paginated\Paginated;
use RaspinuOffice\Shared\Domain\Paginated\PaginatedResponse;

final class FindAllStyle
{
    private StyleResponseRepository $repository;

    public function __construct(StyleResponseRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(Paginated $paginated): PaginatedResponse
    {
        return  $this->repository->allStyle($paginated);
    }

}