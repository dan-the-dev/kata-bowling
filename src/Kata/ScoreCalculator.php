<?php

namespace Kata;

class ScoreCalculator
{
    public static function fromFrames(Frames $frames): Score
    {
        $score = 0;
        foreach ($frames->list() as $pins) {
            $score += array_sum($pins);
        }
        return new Score($score);
    }
}