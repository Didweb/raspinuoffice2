<?php

declare(strict_types=1);

namespace RaspinuOffice\Backoffice\Products\Style\Application\Services;

use RaspinuOffice\Backoffice\Products\Style\Domain\Exceptions\StyleThisNameAlreadyExist;
use RaspinuOffice\Backoffice\Products\Style\Domain\StyleRepository;
use RaspinuOffice\Backoffice\Products\Style\Domain\ValueObjects\StyleName;

final class ThisNameAlreadyExists
{
    private StyleRepository $repository;

    public function __construct(StyleRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(StyleName $name): bool
    {
        $thisNameAlreadyExists = $this->repository->findByName($name);

        if ($thisNameAlreadyExists !== null) {
            throw StyleThisNameAlreadyExist::ofName($name);
        }
        return false;
    }
}