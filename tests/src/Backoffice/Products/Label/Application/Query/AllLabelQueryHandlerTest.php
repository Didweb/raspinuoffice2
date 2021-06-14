<?php

declare(strict_types=1);

namespace RaspinuOffice\Tests\Backoffice\Products\Label\Application\Query;


use PHPUnit\Framework\TestCase;
use RaspinuOffice\Backoffice\Products\Label\Application\Query\AllLabelQuery;
use RaspinuOffice\Backoffice\Products\Label\Application\Query\AllLabelQueryHandler;
use RaspinuOffice\Backoffice\Products\Label\Application\Services\FindAllLabel;
use RaspinuOffice\Backoffice\Products\Label\Infrastructure\Response\LabelResponseConverter;
use RaspinuOffice\Backoffice\Products\Label\Infrastructure\Response\PaginatedLabelResponseConverter;
use RaspinuOffice\Tests\Double\Backoffice\Products\Label\Domain\LabelInMemoryRepositoryResponseStub;
use RaspinuOffice\Tests\Double\Backoffice\Products\Label\Domain\LabelStub;

final class AllLabelQueryHandlerTest extends TestCase
{
    private $useCase;
    private AllLabelQueryHandler $SUT;
    private array $labelRandom;

    protected function setUp(): void
    {
        parent::setUp();
        $genreResponseConverter = new LabelResponseConverter();
        $paginatedGenreResponseConverter = new PaginatedLabelResponseConverter($genreResponseConverter);
        $repositoryResponse = LabelInMemoryRepositoryResponseStub::empty($paginatedGenreResponseConverter);


        $this->useCase = new FindAllLabel($repositoryResponse);
        $this->SUT = new AllLabelQueryHandler($repositoryResponse);


        for ($n = 0; $n < 20;) {
            $label = LabelStub::random();
            $this->labelRandom[$n] = $label;

            $repositoryResponse->save($label);
            $n++;
        }
    }

    public function test_should_list_all_label_page_1(): void
    {
        $query = new AllLabelQuery(1,5);

        $result = $this->SUT->__invoke($query);
        $idRandom = rand(0,4);
        $this->assertEquals((string)$this->labelRandom[$idRandom]->name(), (string)$result->data()[$idRandom]->name());
    }

    public function test_should_list_all_genre_page_2(): void
    {
        $query = new AllLabelQuery(2,5);

        $result = $this->SUT->__invoke($query);

        $idRandom = rand(5,9);
        $this->assertEquals((string)$this->labelRandom[$idRandom]->name(), (string)$result->data()[$idRandom]->name());
    }
}