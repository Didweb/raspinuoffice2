<?php

declare(strict_types=1);

namespace RaspinuOffice\Backoffice\Products\Style\Domain;

use RaspinuOffice\Shared\Domain\Paginated\Paginated;
use RaspinuOffice\Shared\Domain\Paginated\PaginatedResponse;

interface StyleResponseRepository
{
    public function allStyle(Paginated $paginated): PaginatedResponse;
}