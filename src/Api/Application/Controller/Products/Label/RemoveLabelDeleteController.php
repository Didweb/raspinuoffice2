<?php

declare(strict_types=1);

namespace RaspinuOffice\Api\Application\Controller\Products\Label;


use RaspinuOffice\Api\Application\Controller\Products\Label\Request\DeleteLabelRequest;
use RaspinuOffice\Backoffice\Products\Label\Application\Command\DeleteLabelCommand;
use RaspinuOffice\Shared\Infrastructure\Symfony\ApiController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;

final class RemoveLabelDeleteController extends ApiController
{
    /**
     * Remove a label
     *
     * @Route("/label/delete", methods={"DELETE"}, name="api_label_delete")
     * @OA\Tag(
     *     name="Products Label",
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
     *        description="Success: A new Label was created",
     *     ),
     * @OA\Response(
     *        response="202",
     *        description="Accepetd: This label name not exists. ",
     *     ),
     * @OA\Response(
     *        response="204",
     *        description="No Content: This label name not exists. ",
     *     )
     * @param Request $request
     * @return Response
     */
    public function __invoke(Request $request): Response
    {
        $request = DeleteLabelRequest::fromContent($request->toArray());

        $removeLabelCommand = new DeleteLabelCommand(
            $request->id()
        );

        $this->dispatch($removeLabelCommand);

        return $this->makeResponse($removeLabelCommand->_toArray(), Response::HTTP_CREATED);

    }

    protected function exceptions(): array
    {
        return [];
    }
}