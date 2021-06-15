<?php

declare(strict_types=1);

namespace RaspinuOffice\Backoffice\Products\Label\Application\Query;

use RaspinuOffice\Backoffice\Products\Label\Application\Services\FindAllLabel;
use RaspinuOffice\Backoffice\Products\Label\Domain\LabelResponseRepository;
use RaspinuOffice\Shared\Domain\Paginated\Paginated;
use RaspinuOffice\Shared\Domain\Paginated\PaginatedResponse;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final class AllLabelQueryHandler implements MessageHandlerInterface
{
    private LabelResponseRepository $repository;
    private FindAllLabel $findAllLabel;

    public function __construct(LabelResponseRepository $repository)
    {
        $this->repository = $repository;
        $this->findAllLabel = new FindAllLabel($repository);
    }

    public function __invoke(AllLabelQuery $query): PaginatedResponse
    {
        $paginated = Paginated::create($query->page(), $query->pageSize());

        return $this->findAllLabel->__invoke($paginated);
    }
}