<?php

namespace Kata;

class Frames
{
    private $currentFrame = 1;
    /** @var array<array<Roll>> $frames */
    private $frames = [
        1 => [],
        2 => [],
        3 => [],
        4 => [],
        5 => [],
        6 => [],
        7 => [],
        8 => [],
        9 => [],
        10 => [],
    ];

    public function roll(Roll $pins)
    {
        $this->frames[$this->currentFrame][] = $pins;
        if ($this->frameIsOver() || $this->rollIsStrike($pins)) {
            $this->currentFrame++;
        }
    }

    public function list(): array
    {
        return $this->frames;
    }

    public function currentFrame(): int
    {
        return $this->currentFrame;
    }

    /**
     * @return bool
     */
    public function frameIsOver(): bool
    {
        return count($this->frames[$this->currentFrame]) === 2;
    }

    private function rollIsStrike(Roll $pins): bool
    {
        return $pins->isStrike();
    }
}