<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

class MyTest extends TestCase
{
    protected $string_calculator;

    public function testSetup(): void
    {
        $this->string_calculator = new StringCalculator();
    }
}