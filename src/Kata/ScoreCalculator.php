<?php

namespace Kata;

class ScoreCalculator
{
    public static function fromFrames(Frames $frames): Score
    {
        $score = 0;
        $framesList = $frames->list();
        foreach ($framesList as $frame => $rolls) {
            if (empty($rolls)) {
                break;
            }
            /** @var Roll $roll */
            $score += self::frameScore($rolls);
            /** @var Roll $firstRoll */
            $firstRoll = $rolls[0];
            if ($firstRoll->isStrike()){
                $score += self::frameScore($framesList[$frame+1]);
                $score += self::frameScore($framesList[$frame+2]);
            }
        }
        return new Score($score);
    }

    /**
     * @param array $rolls
     * @param int $score
     * @return int
     */
    private static function frameScore(array $rolls): int
    {
        $score = 0;
        foreach ($rolls as $roll) {
            $score += $roll->pins();
        }
        return $score;
    }
}