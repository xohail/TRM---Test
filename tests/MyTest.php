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
        $sum = $this->string_calculator->intAdd('1');
        $this->assertSame(1, $sum);
    }

    /**
     * Test returns sum of the 2 digits passed in string
     */
    public function testTwoDigitString(): void
    {
        $sum = $this->string_calculator->intAdd('1,2');
        $this->assertEquals(3, $sum);
    }

    /**
     * Test returns sum of unknown length of digits passed in the string
     */
    public function testUnknownDigitLengthString(): void
    {
        $sum = $this->string_calculator->intAdd('1,2,3,4,5,6');
        $this->assertEquals(21, $sum);
    }

    /**
     * Test returns sum of digit with \n in it
     */
    public function testHandleNewLineInString(): void
    {
        $sum = $this->string_calculator->intAdd('1\n2,3');
        $this->assertEquals(6, $sum);
    }

    /**
     * Test returns sum of digit with \n at start
     */
    public function testHandleNewLineInStartOfString(): void
    {
        $sum = $this->string_calculator->intAdd('\n1\n2,3');
        $this->assertEquals(6, $sum);
    }

    /**
     * Test returns sum of digit with \n at end
     */
    public function testHandleNewLineInEndOfString(): void
    {
        $sum = $this->string_calculator->intAdd('1\n2,3\n');
        $this->assertEquals(6, $sum);
    }

    /**
     * Test returns sum of digit with \n at both start and end
     */
    public function testHandleNewLineInStartAndEndOfString(): void
    {
        $sum = $this->string_calculator->intAdd('\n1\n2,3\n');
        $this->assertEquals(6, $sum);
    }

    /**
     * Test returns if the string has new delimiter
     */
    public function testIdentifyStringWithNewDelimiter(): void
    {
        $this->assertTrue($this->string_calculator->checkNewDelimiter('//;\n1;2'));
    }

    /**
     * Test returns if the delimiter successfully replace the existing delimiter
     */
    public function testReplaceCommaWithNewDelimiter(): void
    {
        $string = '//;\n1;2';
        $this->assertSame(';', $this->string_calculator->addNewDelimiter($string));
    }

    /**
     * Test returns if the correct string retrieved after finding new delimiter
     */
    public function testRetrieveStringAfterNewDelimiter(): void
    {
        $string = '//;\n1;2';
        if ($this->string_calculator->checkNewDelimiter($string)) {
            $this->assertSame('\n1;2', $this->string_calculator->retrieveString($string));
        }
    }

    /**
     * Test returns if the sum is working with the new delimiter
     */
    public function testSumWithNewDelimiter(): void
    {
        $sum = $this->string_calculator->intAdd('//;\n1;2');
        $this->assertEquals(3, $sum);
    }

    /**
     * Test returns if the correct is retrieved from the string
     */
    public function testRetrieveArray(): void
    {
        $array = $this->string_calculator->retrieveArray('1;2', ';');
        $this->assertEquals([1, 2], $array);
    }

    /**
     * Test if there is a negative value in the string
     */
    public function testNegativeValueInString(): void
    {
        $this->assertTrue($this->string_calculator->checkNegative([1, -2]));
    }

    /**
     * Test if the exception is thrown when negative value is added to the string
     */
    public function testGetNegativeValue(): void
    {
        $this->assertSame(-2, $this->string_calculator->getNegativeValue([1, -2]));
        $this->expectException("Exception");
        $this->expectExceptionMessage("Negatives not allowed -2");
    }

    /**
     * Test if the exception is thrown when negative values are added to the string
     */
    public function testGetMultipleNegativeNumbers(): void
    {
        $this->assertSame('-2 -1', $this->string_calculator->GetMultipleNegativeNumbers([-2, -1, 3]));
        $this->expectException("Exception");
        if ($this->getExpectedException() == 'Exception') {
            $this->assertTrue(true);
        }
        $this->expectExceptionMessage("Negatives not allowed -2 -1");
        if ($this->getExpectedExceptionMessage() == 'Negatives not allowed -2 -1') {
            $this->assertTrue(true);
        }
    }

    /**
     * Test if the number of times the intAdd is called is returned correct
     *
     * @throws Exception
     */
    public function testAddMethodCount(): void
    {
        $this->string_calculator::$count = 0;

        $sum = $this->string_calculator->intAdd('\n1\n2,3\n');
        $sum = $this->string_calculator->intAdd('\n1\n2,3\n');
        $sum = $this->string_calculator->intAdd('\n1\n2,-3\n');

        $this->assertSame(3, $this->string_calculator->getCalledCount());
    }

    public function testCheckIfNumberGreaterThan1000IsIgnored(): void
    {
        $array = $this->string_calculator->retrieveArray('1;2000;23', ';');
        $this->assertEquals([1, 2000, 23], $array);
        $this->assertEquals([1, 23], $this->string_calculator->unsetLargerValues($array));
        $this->assertEquals(24, $this->string_calculator->intAdd('1,23'));
    }
}