<?php

namespace Kata;

class Roll
{
    private $pins;

    public function __construct(int $value)
    {
        $this->pins = $value;
    }

    public function pins(): int
    {
        return $this->pins;
    }

    public function isStrike(): bool
    {
        return $this->pins === 10;
    }
}