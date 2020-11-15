<?php

namespace Kata;

class Bowling
{
    /** @var Frames $frames */
    private $frames;

    public function __construct()
    {
        $this->frames = new Frames();
    }

    public function roll(Pins $pins): void
    {
        $this->frames->roll($pins);
    }

    public function score(): Score
    {
        return ScoreCalculator::fromFrames($this->frames);
    }

    public function currentFrame(): int
    {
        return $this->frames->currentFrame();
    }
}
