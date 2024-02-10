<?php

require __DIR__ . '/../vendor/autoload.php';

use GuzzleHttp\Client;

$baseUri = 'https://hitbtc.com/api/';
$timeout = 2;

$client = new Client([
    'base_uri' => $baseUri,
    'timeout' => $timeout,
]);
