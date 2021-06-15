<?php

declare(strict_types=1);

namespace RaspinuOffice\Api\Application\Controller\Products\Style;


use RaspinuOffice\Backoffice\Products\Style\Application\Query\AllStyleQuery;
use RaspinuOffice\Shared\Infrastructure\Symfony\ApiController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;

final class AllStyleGetController extends ApiController
{
    /**
     * List Style
     *
     * @Route("/style/list", methods={"GET"}, name="api_list_style")
     * @OA\Tag(
     *     name="Products Style",
     *     description="Operations about style"
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
     *        description="Success: Style listed",
     *     )
     *
     */
    public function __invoke(Request $request): Response
    {
        $label = $this->ask(
            new AllStyleQuery(
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