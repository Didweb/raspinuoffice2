<?php

declare(strict_types=1);

namespace RaspinuOffice\Backoffice\Products\Genre\Domain;

use RaspinuOffice\Shared\Domain\Paginated\Paginated;
use RaspinuOffice\Shared\Domain\Paginated\PaginatedResponse;

interface GenreResponseRepository
{
    public function allGenre(Paginated $paginated): PaginatedResponse;
}