<?php

declare(strict_types=1);

namespace RaspinuOffice\Shared\Infrastructure\Symfony;

use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\SerializerInterface;
use RaspinuOffice\Shared\Domain\Bus\Command\Command;
use RaspinuOffice\Shared\Domain\Bus\Command\CommandBus;
use RaspinuOffice\Shared\Domain\Bus\Command\CommandBusInterface;
use RaspinuOffice\Shared\Domain\Bus\Query\MessengerQueryBus;
use RaspinuOffice\Shared\Domain\Bus\Query\Query;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

abstract class ApiController
{
    private CommandBusInterface $commandBusInterface;
    private MessengerQueryBus $queryBusInterface;
    private SerializerInterface $serializer;

    public function __construct(CommandBus $commandBus, MessengerQueryBus $queryBus)
    {
        $this->commandBusInterface = $commandBus;
        $this->queryBusInterface = $queryBus;
        $this->serializer = SerializerBuilder::create()->build();
    }

    abstract protected function exceptions(): array;

    protected function dispatch(Command $command): void
    {
        $this->commandBusInterface->dispatch($command);
    }

    /** @return mixed */
    protected function ask(Query $query)
    {
        return $this->queryBusInterface->handle($query);
    }

    public function makeResponse(array $data, int $httpCode = Response::HTTP_OK): JsonResponse
    {
        return new JsonResponse(
            $this->serializer->serialize($data, 'json'),
            $httpCode,
            [],
            true
        );
    }

    public function makeObjectResponse($response, int $httpCode = Response::HTTP_OK, array $serializationGroups = []): JsonResponse
    {

        return new JsonResponse(
            $this->serializer->serialize(
                $response,
                'json'
            ),
            $httpCode,
            [],
            true
        );
    }
}