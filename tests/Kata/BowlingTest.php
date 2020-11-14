<?php

namespace Kata;

use PHPUnit\Framework\TestCase;
use Kata\Bowling;

class BowlingTest extends TestCase
{
    private $bowling;

    protected function setUp(): void
    {
        $this->bowling = new Bowling();
    }

    public function testShallPass(): void
    {
        $this->assertEquals(1, 1);
    }

    public function testHandleReturnTrue(): void
    {
        $this->assertEquals(true, $this->bowling->handle());
    }
}
