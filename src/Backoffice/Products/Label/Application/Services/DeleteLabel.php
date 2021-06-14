<?php

declare(strict_types=1);

namespace RaspinuOffice\Backoffice\Products\Label\Application\Services;


use RaspinuOffice\Backoffice\Products\Label\Application\Command\DeleteLabelCommand;
use RaspinuOffice\Backoffice\Products\Label\Domain\LabelRepository;
use RaspinuOffice\Backoffice\Products\Label\Domain\ValueObjects\LabelId;

final class DeleteLabel
{
    private LabelRepository $repository;
    private DoesThisIdExist $doesThisIdExist;

    public function __construct(LabelRepository $repository, DoesThisIdExist $doesThisIdExist)
    {
        $this->repository = $repository;
        $this->doesThisIdExist = $doesThisIdExist;
    }

    public function __invoke(DeleteLabelCommand $command): void
    {
        $labelId = LabelId::create($command->id());

        $label = $this->doesThisIdExist->__invoke($labelId);

        if($label) {
            $this->repository->remove($label);
        }

    }
}