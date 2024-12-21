<?php

require_once 'bootstrap.php';

use app\Candle;
use app\Enums\Symbol;
use app\Enums\Period;
use Random\Randomizer;
use GuzzleHttp\Client;

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
$client = new Client(
    [
    'base_uri' => $_ENV['BASE_URI'],
    'timeout' => $_ENV['API_TIMEOUT'],
    'connect_timeout' => $_ENV['API_CONNECT_TIMEOUT'],
    ]
);
for (; $maxQuantity--;) {
    echo "$maxQuantity\n";
    //make random time
    $time = date(
        DATE_ATOM,
        $randomizer->getInt($startDate->format('U'), $endDate->format('U'))
    );
    echo "$time\n";
    //make random balance
    $balance = $randomizer->getFloat(0, $maxAmount);
    echo "$balance\n";
    //make random balance quoted currency
    $params = [
        'query' => [
            'symbols' => $symbol->name,
            'period' => $period->name,
            'till' => $time,
            'limit' => 1,
        ]
    ];
    $response = $client->get($_ENV['API_PATH'], $params);
    $body = json_decode((string)($response->getBody()));
    // var_dump($body);
    $maxAmountQuotedCurrency = $randomizer->getFloat(
        0,
        ($body->{$symbol->name}[0]->open + $body->{$symbol->name}[0]->close) / 2
    );
    echo ($body->{$symbol->name}[0]->open + $body->{$symbol->name}[0]->close) / 2 . "\n";
    echo "$maxAmountQuotedCurrency\n";
    //make random order 1 of 4 times
    echo $randomizer->getInt(0, 4) . "\n";
}