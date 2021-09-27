<?php

namespace Kata;

class Bowling
{
    /** @var int $score */
    private $score = 0;
    /** @var int $rollCount */
    private $rollCount = 0;
    /** @var int $lastRoll */
    private $lastRoll = 0;
    /** @var bool $lastWasSpare */
    private $lastWasSpare = false;

    public function roll(int $pins): void
    {
        $this->score += $pins;
        $this->rollCount ++;
        if ($this->isFrameLastRoll()) {
            $this->handleSpare($pins);
        }
        if ($this->lastWasSpare) {
            $this->score += $pins;
            $this->lastWasSpare = false;
        }
        $this->lastRoll = $pins;
    }

    public function score(): int
    {
        return $this->score;
    }

    /**
     * @return bool
     */
    private function isFrameLastRoll(): bool
    {
        return $this->rollCount % 2 === 0;
    }

    /**
     * @param int $pins
     * @return bool
     */
    private function isSpare(int $pins): bool
    {
        return $pins + $this->lastRoll === 10;
    }

    /**
     * @param int $pins
     */
    private function handleSpare(int $pins): void
    {
        if ($this->isSpare($pins)) {
            $this->lastWasSpare = true;
        }
    }
}
