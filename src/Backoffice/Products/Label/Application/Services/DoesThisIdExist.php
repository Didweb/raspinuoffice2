<?php

declare(strict_types=1);

namespace RaspinuOffice\Backoffice\Products\Label\Application\Services;


use RaspinuOffice\Backoffice\Products\Label\Domain\Exceptions\LabelThisIdExists;
use RaspinuOffice\Backoffice\Products\Label\Domain\Label;
use RaspinuOffice\Backoffice\Products\Label\Domain\LabelRepository;
use RaspinuOffice\Backoffice\Products\Label\Domain\ValueObjects\LabelId;

final class DoesThisIdExist
{
    private LabelRepository $repository;

    public function __construct(LabelRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(LabelId $id): ?Label
    {
        $label = $this->repository->findBy($id);

        if($label === null) {
            throw LabelThisIdExists::ofId($id);
        }
        return $label;
    }
}