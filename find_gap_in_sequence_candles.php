<?php

require_once 'bootstrap.php';

use app\Candle;

$currency = $argv[1];
$quote_currency = $argv[2];
$period = $argv[3];

$batchSize = $_ENV['DB_LIMIT'];

$iterator = $entityManager
    ->getRepository(Candle::class)
    ->findBy(
        [
            'currency' => $currency,
            'quote_currency' => $quote_currency,
            'period' => $period,
        ],
        [
            'time' => 'ASC',
        ]
        )
    ->toIterable();
foreach ($iterator as $candle) {
    var_dump($candle);
    break;
}

