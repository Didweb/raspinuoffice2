<?php

declare(strict_types=1);

namespace RaspinuOffice\Tests\Backoffice\Tests;

use PHPUnit\Framework\TestCase;

final class TestingPhpunitTest extends TestCase
{
    public function test_phpunit(): void
    {
        $this->assertEquals(1, 1);
    }
}