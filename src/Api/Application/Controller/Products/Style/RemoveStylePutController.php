<?php

declare(strict_types=1);

namespace RaspinuOffice\Api\Application\Controller\Products\Style;


use RaspinuOffice\Api\Application\Controller\Products\Style\Request\DeleteStyleRequest;
use RaspinuOffice\Backoffice\Products\Style\Application\Command\DeleteStyleCommand;
use RaspinuOffice\Shared\Infrastructure\Symfony\ApiController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;

final class RemoveStylePutController extends ApiController
{
    /**
     * Remove a Style
     *
     * @Route("/style/delete", methods={"DELETE"}, name="api_style_delete")
     * @OA\Tag(
     *     name="Products Style",
     *     description="Operations about Style"
     * )
     * @OA\RequestBody(
     *        required = true,
     *        description = "Data packet for Style",
     *        @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                property="style",
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
     *        description="Success: A new Style was created",
     *     ),
     * @OA\Response(
     *        response="202",
     *        description="Accepetd: This style name not exists. ",
     *     ),
     * @OA\Response(
     *        response="204",
     *        description="No Content: This style name not exists. ",
     *     )
     * @param Request $request
     * @return Response
     */
    public function __invoke(Request $request): Response
    {
        $request = DeleteStyleRequest::fromContent($request->toArray());

        $removeStyleCommand = new DeleteStyleCommand(
            $request->id()
        );

        $this->dispatch($removeStyleCommand);

        return $this->makeResponse($removeStyleCommand->_toArray(), Response::HTTP_CREATED);

    }

    protected function exceptions(): array
    {
        return [];
    }
}