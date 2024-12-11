<?php

require_once 'bootstrap.php';

use app\Candle;
use app\Enums\Symbol;
use app\Enums\Period;

$symbol = Symbol::{$argv[1]};
$fromDate = $argv[2];
$toDate = $argv[3];
$period = Period::{$argv[4]};
$maxAmount = $argv[5];
$maxQuantity = $argv[6];

$limit = $_ENV['DB_LIMIT'];

$startDate = new DateTime($fromDate);
$endDate = new DateTime($toDate);

for (; $maxQuantity--;) {
    echo "$maxQuantity\n";
}