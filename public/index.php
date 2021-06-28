<?php

require_once __DIR__ . '/../vendor/autoload.php';

use TheRMTest\StringCalculator;

$sc = new StringCalculator();

$sc->intAdd("1,2");
$sc->intAdd("1,2");
$sc->intAdd("1,-12");

echo $sc->getCalledCount();