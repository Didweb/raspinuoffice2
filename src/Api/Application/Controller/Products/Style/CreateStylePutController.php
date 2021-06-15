<?php

declare(strict_types=1);

namespace RaspinuOffice\Api\Application\Controller\Products\Style;


use RaspinuOffice\Api\Application\Controller\Products\Style\Request\CreateStyleRequest;
use RaspinuOffice\Backoffice\Products\Style\Application\Command\CreateStyleCommand;
use RaspinuOffice\Shared\Infrastructure\Symfony\ApiController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;

final class CreateStylePutController extends ApiController
{
    /**
     * Add a Style
     *
     * @Route("/style/add", methods={"PUT"}, name="api_style_add")
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
     *                  "id": "b026b3f4-be48-11eb-8529-0242ac130003",
     *                  "name": "Bolero"
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
     *        description="Success: A new Style was created",
     *     ),
     * @OA\Response(
     *        response="202",
     *        description="Accepetd: This Style name already exists.",
     *     )
     * @param Request $request
     * @return Response
     */
    public function __invoke(Request $request): Response
    {
        $request = CreateStyleRequest::fromContent($request->toArray());

        $createStyleCommand = new CreateStyleCommand(
            $request->id(),
            $request->name(),
        );

        $this->dispatch($createStyleCommand);

        return $this->makeResponse($createStyleCommand->_toArray(), Response::HTTP_CREATED);
    }

    protected function exceptions(): array
    {
        return [];
    }
}