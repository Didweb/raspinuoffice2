<?php

declare(strict_types=1);

namespace RaspinuOffice\Api\Application\Controller\HealthCheck;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;

final class HealthCheckGetController
{
    /**
     * Check API STATUS
     *
     * @Route("/check/status", methods={"GET"}, name="api_check_status")
     * @OA\Tag(
     *     name="Helpers",
     *     description="Operations about Helpers"
     * )
     *
     * @OA\Response(
     *        response="200",
     *        description="Success: Check is OK",
     *     )
     **/
    public function __invoke(Request $request): Response
    {
       return  new Response(json_encode(['Api status' => 'ok']), Response::HTTP_OK);

    }
}