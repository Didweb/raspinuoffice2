<?php

declare(strict_types=1);

namespace RaspinuOffice\Api\Application\Controller\Products\Supplier;


use RaspinuOffice\Api\Application\Controller\Products\Supplier\Request\DeleteSupplierRequest;
use RaspinuOffice\Backoffice\Products\Supplier\Application\Command\DeleteSupplierCommand;
use RaspinuOffice\Shared\Infrastructure\Symfony\ApiController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;

final class RemoveSupplierDeleteController extends ApiController
{
    /**
     * Remove a supplier
     *
     * @Route("/supplier/delete", methods={"DELETE"}, name="api_supplier_delete")
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
     *                  "id": "b026b3f4-be48-11eb-8529-0242ac130003"
     *                }},
     *                @OA\Items(
     *                      @OA\Property(
     *                         property="id",
     *                         type="string",
     *                         example=""
     *                      )
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
     *        description="Accepetd: This Supplier name not exists. ",
     *     ),
     * @OA\Response(
     *        response="204",
     *        description="No Content: This supplier name not exists. ",
     *     )
     * @param Request $request
     * @return Response
     */
    public function __invoke(Request $request): Response
    {
        $request = DeleteSupplierRequest::fromContent($request->toArray());

        $removeSupplierCommand = new DeleteSupplierCommand(
            $request->id()
        );

        $this->dispatch($removeSupplierCommand);

        return $this->makeResponse($removeSupplierCommand->_toArray(), Response::HTTP_CREATED);

    }

    protected function exceptions(): array
    {
        return [];
    }
}