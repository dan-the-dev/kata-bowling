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

    /** @var array $frameHistory */
    public $frameHistory = [];
    /** @var int $currentFrame */
    private $currentFrame = 0;
    /** @var int $currentFrameRoll */
    private $currentFrameRoll = 0;

    public function roll(int $pins): void
    {
        $this->score += $pins;
        $this->rollCount ++;
        if ($this->isLastRollInFrame()) {
            $this->handleSpare($pins);
        }
        if ($this->lastWasSpare()) {
            $this->handleSpareAdditionalPoints($pins);
        }
        $this->lastRoll = $pins;

        $this->saveRollInHistory($pins);
        $this->calculateNextCurrentRoll();
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

    /**
     * @return array|mixed
     */
    private function setupCurrentFrameHistory()
    {
        return (isset($this->frameHistory[$this->currentFrame]) && is_array($this->frameHistory[$this->currentFrame])) ? $this->frameHistory[$this->currentFrame] : [];
    }

    /**
     * @param int $pins
     */
    private function saveRollInHistory(int $pins): void
    {
        $this->frameHistory[$this->currentFrame] = $this->setupCurrentFrameHistory();
        $this->frameHistory[$this->currentFrame][$this->currentFrameRoll] = $pins;
    }

    private function calculateNextCurrentRoll(): void
    {
        $this->currentFrameRoll++;
        if ($this->isLastRollInFrame()) {
            $this->currentFrameRoll = 0;
            $this->currentFrame++;
        }
    }

    /**
     * @param int $pins
     */
    private function handleSpareAdditionalPoints(int $pins): void
    {
        $this->score += $pins;
        $this->lastWasSpare = false;
    }

    /**
     * @return bool
     */
    private function lastWasSpare(): bool
    {
        return $this->lastWasSpare;
    }

    /**
     * @return bool
     */
    private function isLastRollInFrame(): bool
    {
        return $this->currentFrameRoll > 1;
    }
}
