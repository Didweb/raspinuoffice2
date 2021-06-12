<?php

declare(strict_types=1);

namespace RaspinuOffice\Backoffice\Products\Genre\Application\Query;


use RaspinuOffice\Backoffice\Products\Genre\Application\Services\FindAllGenre;
use RaspinuOffice\Backoffice\Products\Genre\Domain\GenreResponseRepository;
use RaspinuOffice\Shared\Domain\Paginated\Paginated;
use RaspinuOffice\Shared\Domain\Paginated\PaginatedResponse;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final class AllGenreQueryHandler implements MessageHandlerInterface
{
    private GenreResponseRepository $repository;
    private FindAllGenre $findAllGenre;

    public function __construct(GenreResponseRepository $repository)
    {
        $this->repository = $repository;
        $this->findAllGenre = new FindAllGenre($repository);
    }

    public function __invoke(AllGenreQuery $query): PaginatedResponse
    {
        $paginated = Paginated::create($query->page(), $query->pageSize());

        return $this->findAllGenre->__invoke($paginated);
    }
}