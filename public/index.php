<?php

require_once __DIR__ . '/../vendor/autoload.php';

use TheRMTest\StringCalculator;

$sc = new StringCalculator();

print $sc->intAdd(''); // Add input here to check explicit input result
print "<br>";
print $sc->intAdd('1'); // Add input here to check explicit input result
print "<br>";
print $sc->intAdd('1,2'); // Add input here to check explicit input result
print "<br>";
print $sc->intAdd('1,2,3,4,5,6'); // Add input here to check explicit input result
print "<br>";
print $sc->intAdd('1\n2,3'); // Add input here to check explicit input result
print "<br>";
print $sc->intAdd('//:\n1:2'); // Add input here to check explicit input result
print "<br>";

try {
    $sc->intAdd('//:\n1:-2'); // Add input here to check explicit input result
} catch (Exception $exception) {
    print $exception->getMessage();
}
print "<br>";
try {
    $sc->intAdd('//:\n1:-2:-3'); // Add input here to check explicit input result
} catch (Exception $exception) {
    print $exception->getMessage();
}
print "<br>";
print $sc->intAdd('//:\n1:2000'); // Add input here to check explicit input result
print "<br>";
print $sc->intAdd('//***\n1***2***3'); // Add input here to check explicit input result
print "<br>";
print $sc->intAdd('//*%\n1*2%3'); // Add input here to check explicit input result
print "<br>";
print $sc->intAdd('//**%%\n1**2%%3'); // Add input here to check explicit input result
print "<br>";
print "<br>";




echo "Total number of time intAdd is called: " . $sc->getCalledCount(); // Times the count function is called