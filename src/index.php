<?php

require __DIR__ . '/../vendor/autoload.php';

use GuzzleHttp\Client;

$baseUri = 'https://api.hitbtc.com/api/3/';
$timeout = 2;
$client = new Client([
    'base_uri' => $baseUri,
    'timeout' => $timeout,
]);
$params = ['query' => [
    'period' => 'M1',
    'from' => '2024-02-12T00:00:00Z',
    'till' => '2024-02-12T00:15:00Z'
]];
// $response = $client->get('public/candles/BTCUSDT', $params);
// $body = $response->getBody();
// echo $body;
