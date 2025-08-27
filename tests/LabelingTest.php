<?php

declare(strict_types=1);

namespace app\Tests;

use PHPUnit\Framework\TestCase;
use app\Service\Labeling;
use Doctrine\ORM\EntityManager;

final class LabelingTest extends TestCase
{
    private EntityManager $entityManager;
    public function setUp(): void
    {
        require 'bootstrap_test.php';
        $this->entityManager = $entityManager;
    }
    public function testLabeling(): void
    {
        $labeling = new Labeling($this->entityManager);
        $labeling->labeling();
        $this->assertLessThan($labeling->getMaxBalance(), $labeling->getBalance());
        $this->assertGreaterThanOrEqual(0, $labeling->getBalance());
        $this->assertLessThan($labeling->getMaxQuoteBalance(), $labeling->getQuoteBalance());
        $this->assertGreaterThanOrEqual(0, $labeling->getQuoteBalance());
    }
}
