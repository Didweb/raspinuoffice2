<?php

declare(strict_types=1);

namespace RaspinuOffice\Api\Application\Controller\Products\Label;


use RaspinuOffice\Backoffice\Products\Label\Application\Query\AllLabelQuery;
use RaspinuOffice\Shared\Infrastructure\Symfony\ApiController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;

final class AllLabelGetController extends ApiController
{
    /**
     * List Label
     *
     * @Route("/labels/list", methods={"GET"}, name="api_list_labels")
     * @OA\Tag(
     *     name="Products Label",
     *     description="Operations about label"
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
     *        description="Success: Label listed",
     *     )
     *
     */
    public function __invoke(Request $request): Response
    {
        $label = $this->ask(
            new AllLabelQuery(
                (int)$request->get('page', 1),
                (int)$request->get('pageSize')
            )
        );

        return $this->makeObjectResponse($label);
    }
    protected function exceptions(): array
    {
        return [];
    }
}