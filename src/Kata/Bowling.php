<?php

namespace Kata;

class Bowling
{

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
        $this->score += $pins;
        array_push($this->rollHistory, $pins);

        if ($this->isFirstRollInFrame()) {
            $previousFrameScore = $this->getPreviousFrameScore();
            if ($previousFrameScore === 10) {
                $this->score += $pins;
            }
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
     * @return float|int
     */
    private function getPreviousFrameScore()
    {
        if (count($this->rollHistory) === 1){
            return 0;
        }
        return array_sum(array_slice($this->rollHistory, -3, 2));
    }
}
