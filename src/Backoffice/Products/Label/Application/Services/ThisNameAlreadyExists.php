<?php

declare(strict_types=1);

namespace RaspinuOffice\Backoffice\Products\Label\Application\Services;

use RaspinuOffice\Backoffice\Products\Label\Domain\Exceptions\LabelThisNameAlreadyExist;
use RaspinuOffice\Backoffice\Products\Label\Domain\LabelRepository;
use RaspinuOffice\Backoffice\Products\Label\Domain\ValueObjects\LabelName;

final class ThisNameAlreadyExists
{
    private LabelRepository $repository;

    public function __construct(LabelRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(LabelName $name): bool
    {
        $thisNameAlreadyExists = $this->repository->findByName($name);

        if ($thisNameAlreadyExists !== null) {
            throw LabelThisNameAlreadyExist::ofName($name);
        }
        return false;
    }
}