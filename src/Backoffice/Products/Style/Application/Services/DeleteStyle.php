<?php

declare(strict_types=1);

namespace RaspinuOffice\Backoffice\Products\Style\Application\Services;


use RaspinuOffice\Backoffice\Products\Style\Application\Command\DeleteStyleCommand;
use RaspinuOffice\Backoffice\Products\Style\Domain\StyleRepository;
use RaspinuOffice\Backoffice\Products\Style\Domain\ValueObjects\StyleId;

final class DeleteStyle
{
    private StyleRepository $repository;
    private DoesThisIdExist $doesThisIdExist;

    public function __construct(StyleRepository $repository, DoesThisIdExist $doesThisIdExist)
    {
        $this->repository = $repository;
        $this->doesThisIdExist = $doesThisIdExist;
    }
    public function __invoke(DeleteStyleCommand $command): void
    {
        $labelId = StyleId::create($command->id());

        $label = $this->doesThisIdExist->__invoke($labelId);

        if($label) {
            $this->repository->remove($label);
        }

    }

}