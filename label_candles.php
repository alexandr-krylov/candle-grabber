<?php

require_once 'bootstrap.php';

use app\Candle;
use app\Enums\Symbol;
use app\Enums\Period;
use Random\Randomizer;

$symbol = Symbol::{$argv[1]};
$fromDate = $argv[2];
$toDate = $argv[3];
$period = Period::{$argv[4]};
$maxAmount = $argv[5];
$maxQuantity = $argv[6];

$limit = $_ENV['DB_LIMIT'];

$startDate = new DateTime($fromDate);
$endDate = new DateTime($toDate);
$randomizer = new Randomizer();

for (; $maxQuantity--;) {
    echo "$maxQuantity\n";
    //make random time
    $time = date(DATE_ATOM, $randomizer->getInt($startDate->format('U'), $endDate->format('U')));
    echo "$time\n";
    $balance = $randomizer->getFloat(0, $maxAmount);
    echo "$balance\n";
    echo $randomizer->getInt(0, 4) . "\n";
    //make random balance quoted currency

    //make random order 1 of 4 times
}