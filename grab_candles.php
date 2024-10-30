<?php

require_once 'bootstrap.php';

use GuzzleHttp\Client;
use app\Candle;
use app\Enums\Symbol;
use app\Enums\Period;

$symbol = $argv[1];
$fromDate = $argv[2];
$toDate = $argv[3];
$period = Period::{$argv[4]};
$limit = 1000;

$startDate = new DateTime($fromDate);
$endDate = new DateTime($toDate);

$client = new Client([
    'base_uri' => $_ENV['BASE_URI'],
    'timeout' => $_ENV['API_TIMEOUT'],
    'connect_timeout' => $_ENV['API_CONNECT_TIMEOUT'],
]);
$delta = $endDate->diff($startDate);
$quantity = ($delta->days * 24 * 60 + $delta->h * 60 + $delta->i) / $period->value; //estimated quantity may be different
while ($quantity > 0) {
    $params = [
        'query' => [
            'symbols' => $symbol,
            'period' => $period->name,
            'from' => $startDate->format('Y-m-d\TH:i:s\Z'),
            'till' => $endDate->format('Y-m-d\TH:i:s\Z'),
            'limit' => $limit,
        ]
    ];
    $response = $client->get($_ENV['API_PATH'], $params);
    $body = json_decode((string)($response->getBody()));
    foreach ($body->$symbol as $data) {
        $candle = new Candle($data);
        $candle->setCurrency(Symbol::{$symbol}->currency());
        $candle->setQuoteCurrency(Symbol::{$symbol}->quoteCurrency());
        $candle->setPeriod($period);
        $candle->setTime(new DateTime($data->timestamp));
        $candle->setOpen($data->open);
        $candle->setClose($data->close);
        $candle->setMin($data->min);
        $candle->setMax($data->max);
        $candle->setVolume($data->volume);
        $candle->setVolumeQuote($data->volume_quote);
        $entityManager->persist($candle);
        $entityManager->flush();
    }
    echo 'till ' . $endDate->format('Y-m-d\TH:i:s\Z') . "\n";
    $endDate->sub(new DateInterval('PT' . $period->value * $limit . 'M'));
    $quantity = $quantity - $limit;
    sleep(2);
}
