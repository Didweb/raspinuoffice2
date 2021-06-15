<?php

declare(strict_types=1);

namespace RaspinuOffice\Api\Application\Controller\Products\Supplier;


use RaspinuOffice\Api\Application\Controller\Products\Supplier\Request\CreateSupplierRequest;
use RaspinuOffice\Shared\Infrastructure\Symfony\ApiController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;

final class CreateLabelPutController extends ApiController
{
    /**
     * Add a Supplier
     *
     * @Route("/supplier/add", methods={"PUT"}, name="api_supplier_add")
     * @OA\Tag(
     *     name="Products Supplier",
     *     description="Operations about Supplier"
     * )
     * @OA\RequestBody(
     *        required = true,
     *        description = "Data packet for Supplier",
     *        @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                property="supplier",
     *                type="array",
     *                example={{
     *                  "id": "b026b3f4-be48-11eb-8529-0242ac130003",
     *                  "name": "DiscoPunt SL"
     *                }},
     *                @OA\Items(
     *                      @OA\Property(
     *                         property="id",
     *                         type="string",
     *                         example=""
     *                      ),
     *                      @OA\Property(
     *                         property="name",
     *                         type="string",
     *                         example=""
     *                      ),
     *                ),
     *             ),
     *        ),
     * )
     * @OA\Response(
     *        response="200",
     *        description="Success: A new Supplier was created",
     *     ),
     * @OA\Response(
     *        response="202",
     *        description="Accepetd: This Supplier name already exists.",
     *     )
     * @param Request $request
     * @return Response
     */
    public function __invoke(Request $request): Response
    {
        $request = CreateSupplierRequest::fromContent($request->toArray());

        $createSupplierCommand = new CreateSupplierCommand(
            $request->id(),
            $request->name(),
        );

        $this->dispatch($createSupplierCommand);

        return $this->makeResponse($createSupplierCommand->_toArray(), Response::HTTP_CREATED);
    }
    protected function exceptions(): array
    {
        return [];
    }
}