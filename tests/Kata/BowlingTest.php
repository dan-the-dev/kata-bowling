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

    public function testTwoRollWith2And3PinsMeans5Point(): void
    {
        $this->simpleFrameRolls();

        $this->assertEquals(5, $this->bowling->score());
    }

    public function testSparePointsAreWellCalculated(): void
    {
        $this->spareFrame();
        $this->bowling->roll(2);
        $this->assertEquals(14, $this->bowling->score());
        $this->bowling->roll(2);
        $this->assertEquals(16, $this->bowling->score());
    }

    public function testStrikePointsAreWellCalculated(): void
    {
        $this->strikeFrame();
        $this->assertEquals(10, $this->bowling->score());
        $this->bowling->roll(2);
        $this->assertEquals(12, $this->bowling->score());
        $this->bowling->roll(3);
        $this->assertEquals(20, $this->bowling->score());
    }

    public function testStrikeAfterSpare(): void
    {
        $this->simpleFrameRolls();
        $this->spareFrame();
        $this->strikeFrame();
        $this->simpleFrameRolls();

        $this->assertEquals(45, $this->bowling->score());
    }

    public function testSpareAfterStrike(): void
    {
        $this->simpleFrameRolls();
        $this->strikeFrame();
        $this->spareFrame();
        $this->simpleFrameRolls();

        $this->assertEquals(43, $this->bowling->score());
    }

    public function testGameStopsAt10thFrame(): void
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

        $this->expectExceptionObject(new GameOverException());

        $this->simpleFrameRolls();

        $this->assertEquals(50, $this->bowling->score());
    }

    private function simpleFrameRolls(): void
    {
        $this->bowling->roll(3);
        $this->bowling->roll(2);
    }

    private function spareFrame(): void
    {
        $this->bowling->roll(6);
        $this->bowling->roll(4);
    }

    private function strikeFrame(): void
    {
        $this->bowling->roll(10);
    }

}
