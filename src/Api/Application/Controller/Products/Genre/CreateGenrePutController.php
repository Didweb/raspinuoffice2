<?php

declare(strict_types=1);

namespace RaspinuOffice\Api\Application\Controller\Products\Genre;


use RaspinuOffice\Api\Application\Controller\Products\Genre\Request\CreateGenreRequest;
use RaspinuOffice\Backoffice\Products\Genre\Application\Command\CreateGenreCommand;
use RaspinuOffice\Shared\Infrastructure\Symfony\ApiController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;

final class CreateGenrePutController extends ApiController
{
    /**
     * Add a Genre
     *
     * @Route("/genre/add", methods={"PUT"}, name="api_genre_add")
     * @OA\Tag(
     *     name="Products Genre",
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
     *                  "id": "b026b3f4-be48-11eb-8529-0242ac130003",
     *                  "name": "Rock"
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
     *        description="Success: A new Genre was created",
     *     ),
     * @OA\Response(
     *        response="204",
     *        description="Success: This genre name already exists.",
     *     )
     * @param Request $request
     * @return Response
     */
    public function __invoke(Request $request): Response
    {

        $request = CreateGenreRequest::fromContent($request->toArray());

        $createGenreCommand = new CreateGenreCommand(
            $request->id(),
            $request->name(),
        );

        $this->dispatch($createGenreCommand);

        return new JsonResponse(
            json_encode($createGenreCommand->_toArray()),
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