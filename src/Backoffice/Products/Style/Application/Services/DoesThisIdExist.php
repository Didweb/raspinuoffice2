<?php

declare(strict_types=1);

namespace RaspinuOffice\Backoffice\Products\Style\Application\Services;


use RaspinuOffice\Backoffice\Products\Style\Domain\Exceptions\StyleThisIdExists;
use RaspinuOffice\Backoffice\Products\Style\Domain\Style;
use RaspinuOffice\Backoffice\Products\Style\Domain\StyleRepository;
use RaspinuOffice\Backoffice\Products\Style\Domain\ValueObjects\StyleId;

final class DoesThisIdExist
{
    private StyleRepository $repository;

    public function __construct(StyleRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(StyleId $id): ?Style
    {
        $label = $this->repository->findBy($id);

        if($label === null) {
            throw StyleThisIdExists::ofId($id);
        }
        return $label;
    }
}