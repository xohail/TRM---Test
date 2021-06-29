<?php

require_once __DIR__ . '/../vendor/autoload.php';

use TheRMTest\StringCalculator;

$sc = new StringCalculator();

echo "Empty case: " .  $sc->intAdd(''); // Add input here to check explicit input result
echo "<br>";
echo "Single digit case: " .  $sc->intAdd('1'); // Add input here to check explicit input result
echo "<br>";
echo "Two digits case: " .  $sc->intAdd('1,2'); // Add input here to check explicit input result
echo "<br>";
echo "Multiple numbers case: " .  $sc->intAdd('1,2,3,4,5,6'); // Add input here to check explicit input result
echo "<br>";
echo "New line case: " .  $sc->intAdd('1\n2,3'); // Add input here to check explicit input result
echo "<br>";
echo "New delimiter case: " .  $sc->intAdd('//:\n1:2'); // Add input here to check explicit input result
echo "<br>";

try {
    $sc->intAdd('//:\n1:-2'); // Add input here to check explicit input result
} catch (Exception $exception) {
    echo "Single negative digit case: " .  $exception->getMessage();
}
echo "<br>";
try {
    $sc->intAdd('//:\n1:-2:-3'); // Add input here to check explicit input result
} catch (Exception $exception) {
    echo "Multiple negative digits case: " .  $exception->getMessage();
}
echo "<br>";
echo "Number greate than 1000 case: " .  $sc->intAdd('//:\n1:2000'); // Add input here to check explicit input result
echo "<br>";
echo "Compound delimiter case: " .  $sc->intAdd('//***\n1***2***3'); // Add input here to check explicit input result
echo "<br>";
echo "Multiple delimiters case: " .  $sc->intAdd('//*%\n1*2%3'); // Add input here to check explicit input result
echo "<br>";
echo "Compound multiple delimiters case: " .  $sc->intAdd('//**%%\n1**2%%3'); // Add input here to check explicit input result
echo "<br>";
echo "<br>";




echo "Total number of time intAdd is called: " . $sc->getCalledCount(); // Times the count function is called