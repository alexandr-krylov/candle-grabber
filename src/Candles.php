<?php

namespace app;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity]
#[ORM\Table(name: 'candles')]
class Candles
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'string')]
    private string $currency;

    #[ORM\Column(type: 'string')]
    private string $quote_currency;

    #[ORM\Column(type: 'string')]
    private string $period;

    #[ORM\Column(type: 'datetime')]
    private DateTime $time;

    #[ORM\Column(type: 'decimal', precision: 20, scale: 14)]
    private string $open;

    #[ORM\Column(type: 'decimal', precision: 20, scale: 14)]
    private string $close;

    #[ORM\Column(type: 'decimal', precision: 20, scale: 14)]
    private string $min;

    #[ORM\Column(type: 'decimal', precision: 20, scale: 14)]
    private string $max;

    #[ORM\Column(type: 'decimal', precision: 20, scale: 14)]
    private string $volume;

    #[ORM\Column(type: 'decimal', precision: 20, scale: 14)]
    private string $volume_quote;
}
