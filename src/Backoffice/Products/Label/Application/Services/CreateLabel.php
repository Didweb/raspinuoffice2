<?php

declare(strict_types=1);

namespace RaspinuOffice\Backoffice\Products\Label\Application\Services;

use RaspinuOffice\Backoffice\Products\Label\Application\Command\CreateLabelCommand;
use RaspinuOffice\Backoffice\Products\Label\Domain\Label;
use RaspinuOffice\Backoffice\Products\Label\Domain\LabelRepository;
use RaspinuOffice\Backoffice\Products\Label\Domain\ValueObjects\LabelId;
use RaspinuOffice\Backoffice\Products\Label\Domain\ValueObjects\LabelName;

class CreateLabel
{
    private LabelRepository $repository;
    private ThisNameAlreadyExists $thisNameAlreadyExists;

    public function __construct(LabelRepository $repository, ThisNameAlreadyExists $thisNameAlreadyExists)
    {
        $this->repository = $repository;
        $this->thisNameAlreadyExists = $thisNameAlreadyExists;
    }

    public function __invoke(CreateLabelCommand $command): void
    {
        $labelName = new LabelName($command->name());

        $this->thisNameAlreadyExists->__invoke($labelName);

        $label = new Label(
            LabelId::create($command->id()),
            $labelName
        );

        $this->repository->save($label);

    }
}