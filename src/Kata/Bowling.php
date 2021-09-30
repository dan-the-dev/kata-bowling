<?php

namespace Kata;

class Bowling
{
    const FRAMES_PER_GAME = 10;
    const ROLLS_PER_FRAME = 2;
    /** @var int $score */
    private $score = 0;
    /** @var array<int> $rollHistory */
    private $rollHistory = [];

    public function score()
    {
        return $this->score;
    }

    public function roll(int $pins)
    {
        if ($this->gameIsOver()) {
            throw new GameOverException();
        }

        $this->score += $pins;
        array_push($this->rollHistory, $pins);

        if ($this->isFirstRollInFrame()) {
            $this->handleSparePoints($pins);
            $this->addEmptyRollForStrike($pins);
        }

        if ($this->isLastRollInFrame()) {
            $this->handleStrikePoints($pins);
        }
    }

    /**
     * @return bool
     */
    private function isFirstRollInFrame(): bool
    {
        return count($this->rollHistory) % 2 === 1;
    }

    /**
     * @return bool
     */
    private function isLastRollInFrame(): bool
    {
        return count($this->rollHistory) % 2 === 0;
    }

    private function previousFrameWasSpare(): bool
    {
        if (count($this->rollHistory) <= 2) {
            return false;
        }
        $previousFrame = array_slice($this->rollHistory, -3, 2);
        $firstRoll = array_slice($previousFrame, 0, 1)[0];
        $secondRoll = array_slice($previousFrame, 1, 1)[0];
        return $firstRoll + $secondRoll === 10 && $secondRoll != 0;
    }

    private function previousFrameWasStrike(): bool
    {
        if (count($this->rollHistory) <= 2) {
            return false;
        }
        $previousFrame = array_slice($this->rollHistory, -4, 2);
        $firstRoll = array_slice($previousFrame, 0, 1)[0];
        $secondRoll = array_slice($previousFrame, 1, 1)[0];
        return $firstRoll === 10 && $secondRoll === 0;
    }

    /**
     * @param int $pins
     */
    private function handleSparePoints(int $pins): void
    {
        if ($this->previousFrameWasSpare()) {
            $this->score += $pins;
        }
    }

    /**
     * @param int $pins
     */
    private function handleStrikePoints(int $pins): void
    {
        if ($this->previousFrameWasStrike()) {
            $previousRollPins = array_slice($this->rollHistory, -2, 1)[0];
            $this->score += $pins + $previousRollPins;
        }
    }

    /**
     * @param int $pins
     */
    private function addEmptyRollForStrike(int $pins): void
    {
        if ($pins === 10) {
            array_push($this->rollHistory, 0);
        }
    }

    /**
     * @return bool
     */
    private function gameIsOver(): bool
    {
        return count($this->rollHistory) >= self::FRAMES_PER_GAME * self::ROLLS_PER_FRAME;
    }
}
