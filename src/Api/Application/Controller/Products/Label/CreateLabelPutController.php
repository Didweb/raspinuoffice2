<?php

declare(strict_types=1);

namespace RaspinuOffice\Api\Application\Controller\Products\Label;

use RaspinuOffice\Api\Application\Controller\Products\Label\Request\CreateLabelRequest;
use RaspinuOffice\Backoffice\Products\Label\Application\Command\CreateLabelCommand;
use RaspinuOffice\Shared\Infrastructure\Symfony\ApiController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;

final class CreateLabelPutController extends ApiController
{
    /**
     * Add a Label
     *
     * @Route("/label/add", methods={"PUT"}, name="api_label_add")
     * @OA\Tag(
     *     name="Label",
     *     description="Operations about Label"
     * )
     * @OA\RequestBody(
     *        required = true,
     *        description = "Data packet for Label",
     *        @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                property="label",
     *                type="array",
     *                example={{
     *                  "id": "b026b3f4-be48-11eb-8529-0242ac130003",
     *                  "name": "EMI Records"
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
     *        description="Success: A new Label was created",
     *     ),
     * @OA\Response(
     *        response="202",
     *        description="Accepetd: This Label name already exists.",
     *     )
     * @param Request $request
     * @return Response
     */
    public function __invoke(Request $request): Response
    {
        $request = CreateLabelRequest::fromContent($request->toArray());

        $createLabelCommand = new CreateLabelCommand(
            $request->id(),
            $request->name(),
        );

        $this->dispatch($createLabelCommand);

        return $this->makeResponse($createLabelCommand->_toArray(), Response::HTTP_CREATED);
    }

    protected function exceptions(): array
    {
        return [];
    }
}