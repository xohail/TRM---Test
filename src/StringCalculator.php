<?php

declare(strict_types=1);

namespace TheRMTest;

class StringCalculator
{
    /**
     * Return sum of digits passed in the string
     *
     * @param $string
     * @return int
     */
    public function intAdd($string): int
    {
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

        // Sanitize input
        $string = str_replace('\n', $delimiter, $string);
        $array = explode($delimiter, $string); // Explode string to array

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
        return substr($string, 2, 1);
    }

    /**
     * Retrieve string to sum after the new delimiter
     *
     * @param $string
     * @return string
     */
    public function retrieveString($string): string
    {
        return substr($string, 3);
    }
}