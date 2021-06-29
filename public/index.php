<?php

require_once __DIR__ . '/../vendor/autoload.php';

use TheRMTest\StringCalculator;

$sc = new StringCalculator();

print $sc->intAdd('//**##\n1**2##3');
print "<br>";
echo $sc->getCalledCount();