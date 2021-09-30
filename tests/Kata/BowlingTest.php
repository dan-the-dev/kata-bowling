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
        $this->bowling->roll(1);

        $this->assertEquals(1, $this->bowling->score());
    }

    public function testRollWith2PinsMeans2Point(): void
    {
        $this->bowling->roll(2);

        $this->assertEquals(2, $this->bowling->score());
    }

    public function testTwoRollWith2PinsMeans4Point(): void
    {
        $this->bowling->roll(2);
        $this->bowling->roll(2);

        $this->assertEquals(4, $this->bowling->score());
    }

    public function testSpareIsRecognized(): void
    {
        $this->bowling->roll(4);
        $this->bowling->roll(6);
        $this->bowling->roll(2);
        $this->bowling->roll(2);

        $this->assertEquals(16, $this->bowling->score());
    }

}
