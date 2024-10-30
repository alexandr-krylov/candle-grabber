<?php

namespace app;

use Doctrine\ORM\EntityRepository;

class CandleRepository extends EntityRepository
{
    public function getDoubleCandles($currency, $quote_currency, $period)
    {
        $dql = "SELECT c.currency, c.quote_currency, c.period, c.time FROM " . Candle::class . " c " .
        "WHERE c.currency = :currency " .
        "AND c.quote_currency = :quote_currency " .
        "AND c.period = :period " .
        "GROUP BY c.currency, c.quote_currency, c.period, c.time " .
        "HAVING COUNT(c.id) > 1";
        return $this
        ->getEntityManager()
        ->createQuery($dql)
        ->setParameters(
            [
                'currency' => $currency,
                'quote_currency' => $quote_currency,
                'period' => $period,
        ])
        ->setMaxResults(1)
        ->getOneOrNullResult();
    }
    public function removeFirstCandle($candle)
    {
        $this->getEntityManager()->remove($this->findOneBy($candle));
        $this->getEntityManager()->flush();
    }
}