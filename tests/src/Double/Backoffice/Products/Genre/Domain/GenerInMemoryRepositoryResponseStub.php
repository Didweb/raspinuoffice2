<?php

declare(strict_types=1);

namespace RaspinuOffice\Tests\Double\Backoffice\Products\Genre\Domain;


use Doctrine\Common\Collections\ArrayCollection;
use RaspinuOffice\Backoffice\Products\Genre\Domain\Genre;
use RaspinuOffice\Backoffice\Products\Genre\Domain\GenreResponseRepository;
use RaspinuOffice\Backoffice\Products\Genre\Domain\ValueObjects\GenreId;
use RaspinuOffice\Backoffice\Products\Genre\Infrastructure\Response\PaginatedGenreResponseConverter;
use RaspinuOffice\Shared\Domain\Paginated\Paginated;
use RaspinuOffice\Shared\Infrastructure\Paginated\PaginatedCollection;
use RaspinuOffice\Shared\Infrastructure\Paginated\PaginatedResponseDoctrine;

final class GenerInMemoryRepositoryResponseStub
{
    public static function empty(PaginatedGenreResponseConverter $paginatedGenreResponseConverter
    ): GenreResponseRepository {
        return self::repository([], $paginatedGenreResponseConverter);
    }

    private static function repository(array $crmData, $paginatedGenreResponseConverter): GenreResponseRepository
    {
        return (
        new class($crmData, $paginatedGenreResponseConverter) implements GenreResponseRepository {
            private ArrayCollection $arrayCollection;
            private PaginatedGenreResponseConverter $paginatedGenreResponseConverter;

            public function __construct(
                ?array $crmData,
                PaginatedGenreResponseConverter $paginatedGenreResponseConverter
            ) {
                $this->arrayCollection = new ArrayCollection($crmData);
                $this->paginatedGenreResponseConverter = $paginatedGenreResponseConverter;
            }


            public function save(Genre $genre): void
            {
                if ($this->arrayCollection->contains($genre)) {
                    $this->arrayCollection->removeElement($genre);
                    $this->arrayCollection->add($genre);
                } else {
                    $this->arrayCollection->add($genre);
                }
            }

            public function findBy(GenreId $id): ?Genre
            {
                $filter = $this->arrayCollection->filter(
                    function (Genre $genre) use ($id) {
                        return $genre->id()->equals($id);
                    }
                );

                return $filter->count() ? $filter->first() : null;
            }

            public function allGenre(Paginated $paginated): PaginatedResponseDoctrine
            {
                $allGenreItemes = $this->arrayCollection->toArray();

                $page = $paginated->page();
                $pageSize = $paginated->pageSize();
                $offset = ($page > 1) ? ($page-1) * ($pageSize) : 0;
                $genrePaginated = array_slice($allGenreItemes, $offset, $pageSize, true);

                return $this->paginatedGenreResponseConverter->__invoke(
                    PaginatedCollection::createFromArray($genrePaginated, count($allGenreItemes)),
                    $paginated
                );
            }
        }
        );
    }
}