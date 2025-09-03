<?php

declare(strict_types=1);

namespace app\Tests;

use PHPUnit\Framework\TestCase;
use app\Service\Labeling;
use Doctrine\ORM\EntityManager;
use PHPUnit\Framework\Attributes\TestWith;
use DateTime;
use Dom\Entity;

final class LabelingTest extends TestCase
{
    private EntityManager $entityManager;
    private EntityManager $realEntityManager;
    public function setUp(): void
    {
        require 'bootstrap.php';
        $this->realEntityManager = $entityManager;
        require 'bootstrap_test.php';
        $this->entityManager = $entityManager;
        //make fake candle data by copying from real data
    }

    #[TestWith([
        'XMR',
        'USDT',
        'M1',
        new DateTime('2017-05-05 15:08:00'),
        new DateTime('2017-05-08 23:59:00')
        ])]
    public function testLabeling(
        string $currency,
        string $quoteCurrency,
        string $period,
        DateTime $startTime,
        DateTime $endTime
    ): void {
        $labeling = new Labeling(
            $this->entityManager,
            $currency,
            $quoteCurrency,
            $period,
            $startTime,
            $endTime
        );
        $labeling->labeling();
        $this->assertLessThan($labeling->getMaxBalance(), $labeling->getBalance());
        $this->assertGreaterThanOrEqual(0, $labeling->getBalance());
        $this->assertLessThan($labeling->getMaxQuoteBalance(), $labeling->getQuoteBalance());
        $this->assertGreaterThanOrEqual(0, $labeling->getQuoteBalance());
    }
}
