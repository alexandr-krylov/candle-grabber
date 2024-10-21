<?php

require_once 'bootstrap.php';

use GuzzleHttp\Client;

$symbol = $argv[1];
$fromDate = $argv[2];
$toDate = $argv[3];
$period = $argv[4];

$startDate = new DateTime($fromDate);
$endDate = new DateTime($toDate);

$client = new Client([
    'base_uri' => $_ENV['BASE_URI'],
    'timeout' => 2,
]);
$params = [
    'query' => [
        'symbols' => $symbol,
        'period' => $period,
        'from' => $startDate->format('Y-m-d\TH:i:s\Z'),
        'till' => $endDate->format('Y-m-d\TH:i:s\Z'),
    ]
];
$response = $client->get($_ENV['API_PATH'], $params);
$body = $response->getBody();
echo $body;

