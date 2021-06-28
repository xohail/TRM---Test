<?php

use TheRMTest\StringCalculator;
use PHPUnit\Framework\TestCase;

class MyTest extends TestCase
{
    protected $string_calculator;

    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->string_calculator = new StringCalculator();
    }

    /**
     * Test if the StringCalculator class exists
     */
    public function testSetup(): void
    {
        $this->assertTrue($this->string_calculator instanceof StringCalculator);
    }

    /**
     * Test returns 0 if empty string is provided
     */
    public function testEmptyString(): void
    {
        $sum = $this->string_calculator->intAdd("");
        $this->assertSame(0, $sum);
    }

    /**
     * Test returns same digit passed in string
     */
    public function testSingleDigitString(): void
    {
        $sum = $this->string_calculator->intAdd("1");
        $this->assertSame(1, $sum);
    }

    /**
     * Test returns sum of the 2 digits passed in string
     */
    public function testTwoDigitString(): void
    {
        $sum = $this->string_calculator->intAdd("1,2");
        $this->assertEquals(3, $sum);
    }
}