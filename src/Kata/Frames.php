<?php

namespace Kata;

class Frames
{
    private $currentFrame = 1;
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

    public function roll(Pins $pins)
    {
        $this->frames[$this->currentFrame][] = $pins->value();
        if (count($this->frames[$this->currentFrame]) === 2) {
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
}