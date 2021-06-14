<?php

declare(strict_types=1);

namespace RaspinuOffice\Tests\Backoffice\Products\Genre\Application\Query;


use PHPUnit\Framework\TestCase;
use RaspinuOffice\Backoffice\Products\Genre\Application\Query\AllGenreQuery;
use RaspinuOffice\Backoffice\Products\Genre\Application\Query\AllGenreQueryHandler;
use RaspinuOffice\Backoffice\Products\Genre\Application\Services\FindAllGenre;
use RaspinuOffice\Backoffice\Products\Genre\Infrastructure\Response\GenreResponseConverter;
use RaspinuOffice\Backoffice\Products\Genre\Infrastructure\Response\PaginatedGenreResponseConverter;
use RaspinuOffice\Tests\Double\Backoffice\Products\Genre\Domain\GenerInMemoryRepositoryResponseStub;
use RaspinuOffice\Tests\Double\Backoffice\Products\Genre\Domain\GenreStub;

final class AllGenreQueryHandlerTest extends TestCase
{

    private $useCase;
    private AllGenreQueryHandler $SUT;
    private array $genreRandom;

    protected function setUp(): void
    {
        parent::setUp();
        $genreResponseConverter = new GenreResponseConverter();
        $paginatedGenreResponseConverter = new PaginatedGenreResponseConverter($genreResponseConverter);
        $repositoryResponse = GenerInMemoryRepositoryResponseStub::empty($paginatedGenreResponseConverter);


        $this->useCase = new FindAllGenre($repositoryResponse);
        $this->SUT = new AllGenreQueryHandler($repositoryResponse);


        for ($n = 0; $n < 20;) {
            $genre = GenreStub::random();
            $this->genreRandom[$n] = $genre;

            $repositoryResponse->save($genre);
            $n++;
        }
    }


    public function test_should_list_all_genre_page_1(): void
    {
        $query = new AllGenreQuery(1,5);

        $result = $this->SUT->__invoke($query);
        $idRandom = rand(0,4);
        $this->assertEquals((string)$this->genreRandom[$idRandom]->name(), (string)$result->data()[$idRandom]->name());
    }

    public function test_should_list_all_genre_page_2(): void
    {
        $query = new AllGenreQuery(2,5);

        $result = $this->SUT->__invoke($query);

        $idRandom = rand(5,9);
        $this->assertEquals((string)$this->genreRandom[$idRandom]->name(), (string)$result->data()[$idRandom]->name());
    }
}