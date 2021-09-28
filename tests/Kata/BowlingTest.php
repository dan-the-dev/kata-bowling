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

    public function testRollWith1PinsMeans1Point(): void
    {
        $this->bowling->pin(1);

        $this->assertEquals(1, $this->bowling->score());
    }

    public function testRollWith2PinsMeans2Point(): void
    {
        $this->bowling->pin(2);

        $this->assertEquals(2, $this->bowling->score());
    }

}
