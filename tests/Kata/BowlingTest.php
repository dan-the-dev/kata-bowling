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

    public function testRollKnockedDownOnePin(): void
    {
        $this->bowling->roll(1);

        $this->assertEquals(1, $this->bowling->score());
    }

    public function testRollKnockedDownNinePins(): void
    {
        $this->bowling->roll(9);

        $this->assertEquals(9, $this->bowling->score());
    }

    public function testFrameMadeByTwoRollsOneAndEightPins(): void
    {
        $this->bowling->roll(1);
        $this->bowling->roll(8);

        $this->assertEquals(9, $this->bowling->score());
    }

    public function testSpareFramePointsIsCorrectlyCalculated(): void
    {
        $this->bowling->roll(8);
        $this->bowling->roll(2);

        $this->bowling->roll(2);
        $this->bowling->roll(3);

        $this->assertEquals(17, $this->bowling->score());
    }


}
