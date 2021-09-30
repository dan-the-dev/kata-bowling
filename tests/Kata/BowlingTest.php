<?php

namespace Kata;

use PHPUnit\Framework\TestCase;

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

    public function testSparePointsAreWellCalculated(): void
    {
        $this->bowling->roll(4);
        $this->assertEquals(4, $this->bowling->score());
        $this->bowling->roll(6);
        $this->assertEquals(10, $this->bowling->score());
        $this->bowling->roll(2);
        $this->assertEquals(14, $this->bowling->score());
        $this->bowling->roll(2);
        $this->assertEquals(16, $this->bowling->score());
    }

    public function testStrikePointsAreWellCalculated(): void
    {
        $this->bowling->roll(10);
        $this->assertEquals(10, $this->bowling->score());
        $this->bowling->roll(2);
        $this->assertEquals(12, $this->bowling->score());
        $this->bowling->roll(3);
        $this->assertEquals(20, $this->bowling->score());
    }

    public function testFullGameWithoutStrikeAndSpares(): void
    {
        $this->simpleFrameRolls();
        $this->simpleFrameRolls();
        $this->simpleFrameRolls();
        $this->simpleFrameRolls();
        $this->simpleFrameRolls();
        $this->simpleFrameRolls();
        $this->simpleFrameRolls();
        $this->simpleFrameRolls();
        $this->simpleFrameRolls();
        $this->simpleFrameRolls();

        $this->assertEquals(50, $this->bowling->score());
    }

    private function simpleFrameRolls(): void
    {
        $this->bowling->roll(3);
        $this->bowling->roll(2);
    }

}
