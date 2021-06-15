<?php

declare(strict_types=1);

namespace RaspinuOffice\Backoffice\Products\Style\Application\Query;


use RaspinuOffice\Backoffice\Products\Style\Application\Services\FindAllStyle;
use RaspinuOffice\Backoffice\Products\Style\Domain\StyleResponseRepository;
use RaspinuOffice\Shared\Domain\Paginated\Paginated;
use RaspinuOffice\Shared\Domain\Paginated\PaginatedResponse;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final class AllStyleQueryHandler implements MessageHandlerInterface
{
    private StyleResponseRepository $repository;
    private FindAllStyle $findAllStyle;

    public function __construct(StyleResponseRepository $repository)
    {
        $this->repository = $repository;
        $this->findAllStyle = new FindAllStyle($repository);
    }

    public function __invoke(AllStyleQuery $query): PaginatedResponse
    {
        $paginated = Paginated::create($query->page(), $query->pageSize());

        return $this->findAllStyle->__invoke($paginated);
    }

}