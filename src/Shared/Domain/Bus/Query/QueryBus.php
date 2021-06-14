<?php

declare(strict_types=1);

namespace RaspinuOffice\Shared\Domain\Bus\Query;


use RaspinuOffice\Backoffice\Products\Genre\Application\Query\AllGenreQueryHandler;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Messenger\Exception\HandlerFailedException;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;
use Throwable;

interface  QueryBus
{
    /** @return mixed */
    public function handle(Query $query);
}