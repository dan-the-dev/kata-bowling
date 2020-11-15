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

    public function testFrameScoreWith2Rolls1And2Returns3AndMoveNextFrame(): void
    {
        $this->bowling->roll(new Roll(1));
        $this->bowling->roll(new Roll(2));
        $actualScore = $this->bowling->score()->value();
        $actualCurrentFrame = $this->bowling->currentFrame();

        $this->assertEquals(3, $actualScore);
        $this->assertEquals(2, $actualCurrentFrame);
    }

    public function testFrameScoreWith2Rolls2And3Returns5AndMoveNextFrame(): void
    {
        $this->bowling->roll(new Roll(2));
        $this->bowling->roll(new Roll(3));
        $actualScore = $this->bowling->score()->value();
        $actualCurrentFrame = $this->bowling->currentFrame();

        $this->assertEquals(5, $actualScore);
        $this->assertEquals(2, $actualCurrentFrame);
    }

    public function testFrameWith1Roll1Returns1AndStayOnSameFrame(): void
    {
        $this->bowling->roll(new Roll(1));
        $actualScore = $this->bowling->score()->value();
        $actualCurrentFrame = $this->bowling->currentFrame();

        $this->assertEquals(1, $actualScore);
        $this->assertEquals(1, $actualCurrentFrame);
    }

    public function testFrameWithStrikeReturns10AndMoveNextFrame(): void
    {
        $this->bowling->roll(new Roll(10));
        $actualScore = $this->bowling->score()->value();
        $actualCurrentFrame = $this->bowling->currentFrame();

        $this->assertEquals(10, $actualScore);
        $this->assertEquals(2, $actualCurrentFrame);
    }

    public function testFrameWithSpareReturns10AndMoveNextFrame(): void
    {
        $this->bowling->roll(new Roll(6));
        $this->bowling->roll(new Roll(4));
        $actualScore = $this->bowling->score()->value();
        $actualCurrentFrame = $this->bowling->currentFrame();

        $this->assertEquals(10, $actualScore);
        $this->assertEquals(2, $actualCurrentFrame);
    }

    public function testScoreIsCalcUlatedCorrectlyWhenAStrikeOccur(): void
    {
        $this->bowling->roll(new Roll(10));
        $this->bowling->roll(new Roll(5));
        $this->bowling->roll(new Roll(5));
        $this->bowling->roll(new Roll(9));
        $actualScore = $this->bowling->score()->value();
        $actualCurrentFrame = $this->bowling->currentFrame();

        $this->assertEquals(48, $actualScore);
        $this->assertEquals(3, $actualCurrentFrame);
    }

}
