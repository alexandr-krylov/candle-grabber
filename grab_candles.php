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
$limit = $_ENV['DB_LIMIT'];

$startDate = new DateTime($fromDate);
$endDate = new DateTime($toDate);

$client = new Client(
    [
    'base_uri' => $_ENV['BASE_URI'],
    'timeout' => $_ENV['API_TIMEOUT'],
    'connect_timeout' => $_ENV['API_CONNECT_TIMEOUT'],
    ]
);
$delta = $endDate->diff($startDate);
$respository = $entityManager->getRepository(Candle::class);
while ($endDate > $startDate) {
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
        $isExists = $respository->findOneBy(
            [
                'currency' => Symbol::{$symbol}->currency(),
                'quote_currency' => Symbol::{$symbol}->quoteCurrency(),
                'period' => $period->name,
                'time' => new DateTime($data->timestamp),
            ]
        );
        if (null !== $isExists) continue;
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
        $entityManager->clear();
    }
    echo 'till ' . $endDate->format('Y-m-d\TH:i:s\Z') . "\n";
    $endDate = (new DateTime($data->timestamp))->sub(new DateInterval('PT' . $period->value . 'M'));
    sleep(2);
}
