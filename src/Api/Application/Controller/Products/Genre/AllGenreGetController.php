<?php

declare(strict_types=1);

namespace RaspinuOffice\Api\Application\Controller\Products\Genre;

use RaspinuOffice\Backoffice\Products\Genre\Application\Query\AllGenreQuery;
use RaspinuOffice\Shared\Infrastructure\Symfony\ApiController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;

final class AllGenreGetController extends ApiController
{
    /**
     * List Genre
     *
     * @Route("/list/genres", methods={"GET"}, name="api_list_genres")
     * @OA\Tag(
     *     name="Products Genre",
     *     description="Operations about genre"
     * ),
     * @OA\Parameter(parameter="page",name="page",
     *     description="Requested page number",
     *     @OA\Schema(type="string"),
     *     in="query", required=false)
     * @OA\Parameter(parameter="pageSize",name="pageSize",
     *     description="Page size. Number of elements per page.",
     *     @OA\Schema(type="string"), in="query", required=false),
     * @OA\Response(
     *        response="200",
     *        description="Success: Genre listed",
     *     )
     *
     */
    public function __invoke(Request $request): Response
    {
        $genre = $this->ask(
            new AllGenreQuery(
                (int)$request->get('page', 1),
                (int)$request->get('pageSize')
            )
        );

        return $this->makeResponse($genre);
    }

    protected function exceptions(): array
    {
        return [];
    }
}