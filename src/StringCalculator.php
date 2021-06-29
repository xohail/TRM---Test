<?php

declare(strict_types=1);

namespace TheRMTest;

use PHPUnit\Exception;

class StringCalculator
{
    public static $count=0;

    /**
     * Return sum of digits passed in the string
     *
     * @param $string
     * @return int
     * @throws \Exception
     */
    public function intAdd($string): int
    {
        self::$count++; // Increment each time the method is called

        // Empty string case
        if (empty($string)) {
            return 0;
        }

        // If new delimiter is added to the string; retrieve and process
        $delimiter = ',';
        if ($this->checkNewDelimiter($string)) {
            $delimiter = $this->addNewDelimiter($string);
            $string = $this->retrieveString($string);
        }

        // Sanitize & retrieve input
        $array = $this->retrieveArray($string, $delimiter);
        $array = $this->unsetLargerValues($array);
        array_values($array);

        // Check negative value
        try {
            if ($this->checkNegative($array)) {
                $negative_string = $this->GetMultipleNegativeNumbers($array);
                throw new \Exception("Negatives not allowed " . $negative_string);
            }
        } catch (\Exception $exception) {}

        // For single digit string
        if (count($array) == 1) {
            return (int) $array[0];
        } elseif (count($array) == 1) {
            // For two digits string
            return (int) $array[0]+$array[1];
        } else {
            // Sum all digits in the string
            return (int) array_sum($array);
        }
    }

    /**
     * Check if new delimiter is added to the string
     *
     * @param $string
     * @return bool
     */
    public function checkNewDelimiter($string): bool
    {
        return substr($string, 0, 2) == '//';
    }

    /**
     * Replace comma with new delimiter
     *
     * @param $string
     * @return string
     */
    public function addNewDelimiter($string): string
    {
        return substr($string, 2, $this->getNewLinePosition($string) - 2);
    }

    public function getNewLinePosition($string): int
    {
        return strpos($string, '\n');
    }

    /**
     * Retrieve string to sum after the new delimiter
     *
     * @param $string
     * @return string
     */
    public function retrieveString($string): string
    {
        return substr($string, $this->getNewLinePosition($string) + 2);
    }

    /**
     * Retrieve array from the string
     *
     * @param $string
     * @param $delimiter
     * @return array
     */
    public function retrieveArray($string, $delimiter): array
    {
        $string = str_replace('\n', $delimiter, $string);
        return explode($delimiter, $string); // Explode string to array
    }

    /**
     * Check if array has a negative value
     *
     * @param $array
     * @return bool
     */
    public function checkNegative($array): bool
    {
        return min($array) < 0;
    }

    /**
     * Get the negative value from array
     *
     * @param $array
     * @return int
     */
    public function getNegativeValue($array): int
    {
        return (int) min($array);
    }

    /**
     * Get string of negative numbers from the array
     *
     * @param $array
     * @return string
     */
    public function GetMultipleNegativeNumbers($array): string
    {
        $neg = array_filter($array, function($x) {
            return $x < 0;
        });

        return implode(" ", $neg);
    }

    /**
     * Return count of times the intAdd method is called
     *
     * @return int
     */
    public function getCalledCount(): int
    {
        return self::$count;
    }

    /**
     * Filter numbers greater than 1000
     *
     * @param $array
     * @return array
     */
    public function unsetLargerValues($array): array
    {
        $filter = array_filter($array, function($x) {
            return $x <= 1000;
        });

        $res = array();
        foreach ($filter as $key => $value) {
            if (!empty($value)) {
                $res[] = $value;
            }
        }

        if (!empty($res)) {
            $filter = $res;
        }

        return $filter;
    }
}