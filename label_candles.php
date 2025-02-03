<?php

require_once 'bootstrap.php';

use app\Label;
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
$candleRepository = $entityManager->getRepository(Candle::class);
for (; $maxQuantity--;) {
    echo "number $maxQuantity\n";
    //make random time
    $time = date(
        DATE_ATOM,
        $randomizer->getInt($startDate->format('U'), $endDate->format('U'))
    );
    echo "time $time\n";
    //make random balance
    $balance = $randomizer->getFloat(0, $maxAmount);
    echo "balance $balance\n";
    $candle = $candleRepository->findOneBy(
        [
            'currency' => $symbol->currency(),
            'quote_currency' => $symbol->quoteCurrency(),
            'period' => $period->name,
        ],
        ['time' => 'ASC'],
        1,
        ['time > :time'],
        ['time' => $time]
    );
    var_dump($candle);
    // die;
    // $body = json_decode((string)($response->getBody()));
    // var_dump($body);
    $middlePrice = ($candle->getOpen() + $candle->getClose()) / 2;
    echo "middle price $middlePrice\n";
    $maxAmountQuotedCurrency = $middlePrice * $maxAmount;
    echo "max amount quoted currency $maxAmountQuotedCurrency\n";
    $amountQuotedCurrency = $randomizer->getFloat(
        0,
        $middlePrice * $maxAmount
    );
    echo "amount quoted currency $amountQuotedCurrency\n";
    //make random order 1 of 4 times
    echo "0 - buy order, 1 - sell order, other - no order " . $randomizer->getInt(0, 4) . "\n";
    // $data['symbol'] = $symbol->name;
    
    // $data['date'] = $time;
    // $data['currency_balance'] = $balance;
    // $data['quote_currency_balance'] = $amountQuotedCurrency;
    // $data['order'] = $randomizer->getInt(0, 4);
    // echo "Data for Label creation: " . json_encode($data) . "\n";
    // $label = new Label($data);
    // var_dump($label);
    // $entityManager->persist($label);
    // $entityManager->flush();
    // $entityManager->clear();
}