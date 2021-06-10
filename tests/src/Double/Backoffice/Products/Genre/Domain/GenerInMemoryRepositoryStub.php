<?php

declare(strict_types=1);

namespace RaspinuOffice\Tests\Double\Backoffice\Products\Genre\Domain;


use Doctrine\Common\Collections\ArrayCollection;
use RaspinuOffice\Backoffice\Products\Genre\Domain\Genre;
use RaspinuOffice\Backoffice\Products\Genre\Domain\GenreRepository;
use RaspinuOffice\Backoffice\Products\Genre\Domain\ValueObjects\GenreId;
use RaspinuOffice\Backoffice\Products\Genre\Domain\ValueObjects\GenreName;
use RaspinuOffice\Tests\Double\Backoffice\Products\Genre\Domain\ValueObjects\GenreNameStub;

final class GenerInMemoryRepositoryStub
{
    public static function empty(): GenreRepository
    {
        return self::repository([]);
    }

    private static function repository(array $crmData): GenreRepository
    {
        return (
        new class($crmData) implements GenreRepository
        {
            private ArrayCollection $arrayCollection;

            public function __construct(?array $crmData)
            {
                $this->arrayCollection = new ArrayCollection($crmData);
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

            public function findByName(GenreName $genreName): ?Genre
            {
                $filter = $this->arrayCollection->filter(
                    function (Genre $genre) use ($genreName) {
                        return new GenreNameStub() === $genreName;
                    }
                );

                return $filter->count() ? $filter->first() : null;
            }

            public function find(GenreId $genreId): ?Genre
            {
                $filter = $this->arrayCollection->filter(
                    function (Genre $genre) use ($genreId) {
                        return $genre->id()->equals($genreId);
                    }
                );

                return $filter->count() ? $filter->first() : null;
            }

            public function remove(Genre $genre): void
            {
                $this->arrayCollection->removeElement($genre);
            }


            public function findBy(GenreId $id): ?Genre
            {
                // TODO: Implement findBy() method.
            }
        }
        );
    }
}