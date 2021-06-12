<?php

declare(strict_types=1);

namespace RaspinuOffice\Shared\Infrastructure\Paginated;



use ArrayIterator;
use Closure;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Query;
use Doctrine\ORM\Tools\Pagination\Paginator;

final class PaginatedCollection
{
    private ArrayCollection $collection;
    private int $total;

    private function __construct(ArrayCollection $data, int $total)
    {
        $this->collection = $data;
        $this->total = $total;
    }
    public static function createFromQuery(Query $query, Paginated $paginated): self
    {
        $query->setFirstResult($paginated->offset());
        $query->setMaxResults($paginated->pageSize());

        $paginator = new Paginator($query);

        /** @var ArrayIterator $arrayIterator */
        $arrayIterator = $paginator->getIterator();
        $data = $arrayIterator->getArrayCopy();

        return new self(
            new ArrayCollection($data),
            $paginator->count()
        );
    }

    public static function createFromArray(array $data, int $total): self
    {
        return new self(
            new ArrayCollection($data),
            $total
        );
    }

    public function collection(): ArrayCollection
    {
        return $this->collection;
    }

    public function totalCollection(): int
    {
        return $this->collection()->count();
    }

    public function map(Closure $param): ArrayCollection
    {
        return $this->collection()->map($param);
    }

    public function mapToArray(Closure $param): array
    {
        return $this->collection()->map($param)->toArray();
    }

    public function total(): int
    {
        return $this->total;
    }
}