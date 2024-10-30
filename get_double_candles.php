<?php

require_once 'bootstrap.php';

use app\Candle;

$currency = $argv[1];
$quote_currency = $argv[2];
$period = $argv[3];

echo json_encode($entityManager->getRepository(Candle::class)->getDoubleCandles($currency, $quote_currency, $period));
