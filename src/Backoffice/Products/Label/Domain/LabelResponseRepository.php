<?php

declare(strict_types=1);

namespace RaspinuOffice\Backoffice\Products\Label\Domain;


use RaspinuOffice\Shared\Domain\Paginated\Paginated;
use RaspinuOffice\Shared\Domain\Paginated\PaginatedResponse;

interface LabelResponseRepository
{
    public function allLabel(Paginated $paginated): PaginatedResponse;
}