<?php

namespace Kata;

class Bowling
{

    /**
     * @var int
     */
    private $score;

    public function score()
    {
        return $this->score;
    }

    public function pin(int $int)
    {
        $this->score = $int;
    }
}
