<?php

declare(strict_types=1);

namespace TheRMTest;

class StringCalculator
{
    public function intAdd($string): int
    {

        // Empty string case
        if (empty($string)) {
            return 0;
        }

        // Sanitize input
        $string = str_replace("\n", ",", $string);
        $array = explode(",", $string); // Explode string to array

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
}