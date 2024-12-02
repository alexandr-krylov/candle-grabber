<?php

require_once 'bootstrap.php';

use app\Candle;
use app\Enums\Period;
use Doctrine\ORM\Query\Parameter;
use Doctrine\Common\Collections\ArrayCollection;

$currency = $argv[1];
$quote_currency = $argv[2];
$period = $argv[3];

$iterator = $entityManager
    ->createQueryBuilder()
    ->select('c')
    ->from(Candle::class, 'c')
    ->where('c.currency = :currency')
    ->andWhere('c.quote_currency = :quote_currency')
    ->andWhere('c.period = :period')
    ->orderBy('c.time', 'ASC')
    ->setParameters(new ArrayCollection([
            new Parameter('currency', $currency),
            new Parameter('quote_currency', $quote_currency),
            new Parameter('period', $period),
        ])
    )
    ->getQuery()
    ->toIterable();
$previous = null;

foreach ($iterator as $candle) {
    if (null === $previous) {
        $previous = $candle;
        continue;
    }
    $interval = $previous->getTime()->diff($candle->getTime());
    if ($interval->i + 60 * $interval->h + 1440 * $interval->d > Period::{$period}->value) {
        echo "Gap detected! {$previous->getTime()->format('Y-m-d H:i:s')} ---- {$candle->getTime()->format('Y-m-d H:i:s')}\n";
    }
    $previous = $candle;
    $entityManager->detach($candle);
}
