<?php

declare(strict_types=1);

namespace RaspinuOffice\Tests\Backoffice\Products\Style\Application\Query;


use PHPUnit\Framework\TestCase;
use RaspinuOffice\Backoffice\Products\Style\Application\Query\AllStyleQuery;
use RaspinuOffice\Backoffice\Products\Style\Application\Query\AllStyleQueryHandler;
use RaspinuOffice\Backoffice\Products\Style\Application\Services\FindAllStyle;
use RaspinuOffice\Backoffice\Products\Style\Infrastructure\Response\PaginatedStyleResponseConverter;
use RaspinuOffice\Backoffice\Products\Style\Infrastructure\Response\StyleResponseConverter;
use RaspinuOffice\Tests\Double\Backoffice\Products\Style\StyleInMemoryRepositoryResponseStub;
use RaspinuOffice\Tests\Double\Backoffice\Products\Style\StyleStub;

final class AllStyleQueryHandlerTest extends TestCase
{
    private $useCase;
    private AllStyleQueryHandler $SUT;
    private array $styleRandom;

    protected function setUp(): void
    {
        parent::setUp();
        $styleResponseConverter = new StyleResponseConverter();
        $paginatedStyleResponseConverter = new PaginatedStyleResponseConverter($styleResponseConverter);
        $repositoryResponse = StyleInMemoryRepositoryResponseStub::empty($paginatedStyleResponseConverter);


        $this->useCase = new FindAllStyle($repositoryResponse);
        $this->SUT = new AllStyleQueryHandler($repositoryResponse);


        for ($n = 0; $n < 20;) {
            $style = StyleStub::random();
            $this->styleRandom[$n] = $style;

            $repositoryResponse->save($style);
            $n++;
        }
    }

    public function test_should_list_all_style_page_1(): void
    {
        $query = new AllStyleQuery(1,5);

        $result = $this->SUT->__invoke($query);
        $idRandom = rand(0,4);
        $this->assertEquals((string)$this->styleRandom[$idRandom]->name(), (string)$result->data()[$idRandom]->name());
    }

    public function test_should_list_all_style_page_2(): void
    {
        $query = new AllStyleQuery(2,5);

        $result = $this->SUT->__invoke($query);

        $idRandom = rand(5,9);
        $this->assertEquals((string)$this->styleRandom[$idRandom]->name(), (string)$result->data()[$idRandom]->name());
    }
}