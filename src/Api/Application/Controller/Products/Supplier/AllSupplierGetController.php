<?php

declare(strict_types=1);

namespace RaspinuOffice\Api\Application\Controller\Products\Supplier;


use RaspinuOffice\Backoffice\Products\Label\Application\Query\AllLabelQuery;
use RaspinuOffice\Backoffice\Products\Supplier\Application\Query\AllSupplierQuery;
use RaspinuOffice\Shared\Infrastructure\Symfony\ApiController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;

final class AllSupplierGetController extends ApiController
{
    /**
     * List Supplier
     *
     * @Route("/supplier/list", methods={"GET"}, name="api_list_suppliers")
     * @OA\Tag(
     *     name="Products Supplier",
     *     description="Operations about supplier"
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
     *        description="Success: Supplier listed",
     *     )
     *
     */
    public function __invoke(Request $request): Response
    {
        $supplier = $this->ask(
            new AllSupplierQuery(
                (int)$request->get('page', 1),
                (int)$request->get('pageSize')
            )
        );

        return $this->makeObjectResponse($supplier);
    }

    protected function exceptions(): array
    {
        return [];
    }
}