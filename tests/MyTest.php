<?php

use TheRMTest\StringCalculator;
use PHPUnit\Framework\TestCase;

class MyTest extends TestCase
{
    protected $string_calculator;

    /**
     * Test if the StringCalculator class exists
     */
    public function testSetup(): void
    {
        $this->string_calculator = new StringCalculator();
        $this->assertTrue($this->string_calculator instanceof StringCalculator);
    }
}