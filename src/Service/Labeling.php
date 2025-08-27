<?php

namespace app\Service;

use DateTime;
use app\Candle;
use Doctrine\ORM\EntityManager;

class Labeling
{
    // private string $currency;
    // private string $quoteCurrency;
    // private string $period;
    // private DateTime $startTime;
    // private DateTime $endTime;

    private string $balance = '0';
    private float $maxBalance = 1;
    private string $quoteBalance = '0';
    private float $maxQuoteBalance = 0.0025;

    // private EntityManager $em;

    public function __construct(
        private EntityManager $em,
        private string $currency,
        private string $quoteCurrency,
        private string $period,
        private DateTime $startTime,
        private DateTime $endTime
    ) {
    }
   
    private function generateBalance()
    {
        $this->balance = rand() * $this->maxBalance / getrandmax();
        $this->quoteBalance = rand() * $this->maxQuoteBalance / getrandmax();
    }
    public function getBalance(): float
    {
        return (float)$this->balance;
    }
    public function getMaxBalance(): float
    {
        return $this->maxBalance;
    }
    public function getQuoteBalance(): float
    {
        return (float)$this->quoteBalance;
    }
    public function getMaxQuoteBalance(): float
    {
        return $this->maxQuoteBalance;
    }
    public function labeling(): void
    {
        $this->generateBalance();
        $dql = "SELECT c FROM " . Candle::class . " c " .
        "WHERE c.currency = :currency " .
        "AND c.quote_currency = :quote_currency " .
        "AND c.period = :period " .
        "AND c.time >= :start_time " .
        "AND c.time <= :end_time " .
        "ORDER BY c.time ASC";

        $query = $this->em->createQuery($dql);
        $query->setParameter('currency', $this->currency);
        $query->setParameter('quote_currency', $this->quoteCurrency);
        $query->setParameter('period', $this->period);
        $query->setParameter('start_time', $this->startTime);
        $query->setParameter('end_time', $this->endTime);
        $candles = $query->getResult();
    }
}
