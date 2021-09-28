<?php

namespace Kata;

use PHPUnit\Framework\TestCase;
use Kata\Bowling;

class BowlingTest extends TestCase
{
    private $bowling;

    protected function setUp(): void
    {
        $this->bowling = new Bowling();
    }

}
