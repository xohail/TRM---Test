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

        // Explode string to array
        $array = explode(",", $string);

        // For single digit string
        if (count($array) == 1) {
            return (int) $array[0];
        }

        // For two digits string
        return array_sum($array);
    }
}