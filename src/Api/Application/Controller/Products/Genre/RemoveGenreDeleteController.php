<?php

declare(strict_types=1);

namespace RaspinuOffice\Api\Application\Controller\Products\Genre;


use RaspinuOffice\Api\Application\Controller\Products\Genre\Request\DeleteGenreRequest;
use RaspinuOffice\Backoffice\Products\Genre\Application\Command\DeleteGenreCommand;
use RaspinuOffice\Shared\Infrastructure\Symfony\ApiController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;

final class RemoveGenreDeleteController  extends ApiController
{
    /**
     * Remove a genre
     *
     * @Route("/genre/delete", methods={"DELETE"}, name="api_genre_delete")
     * @OA\Tag(
     *     name="Genre",
     *     description="Operations about Genre"
     * )
     * @OA\RequestBody(
     *        required = true,
     *        description = "Data packet for Gener",
     *        @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                property="genre",
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
     *        description="Success: A new Genre was created",
     *     ),
     * @OA\Response(
     *        response="202",
     *        description="Accepetd: This genre name not exists. ",
     *     ),
     * @OA\Response(
     *        response="204",
     *        description="No Content: This genre name not exists. ",
     *     )
     * @param Request $request
     * @return Response
     */
    public function __invoke(Request $request): Response
    {
        $request = DeleteGenreRequest::fromContent($request->toArray());

        $removeGenreCommand = new DeleteGenreCommand(
            $request->id()
        );

        $this->dispatch($removeGenreCommand);

        return new JsonResponse(
            json_encode($removeGenreCommand->_toArray()),
            Response::HTTP_CREATED,
            [],
            true
        );

    }

    protected function exceptions(): array
    {
        return [];
    }
}