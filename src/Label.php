<?php

namespace app;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'labels')]
class Label
{
    
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $symbol;

    #[ORM\Column(type: 'datetime')]
    private DateTime $date;

    #[ORM\Column(type: 'decimal', precision: 24, scale: 14)]
    private string $currency_balance;

    #[ORM\Column(type: 'decimal', precision: 24, scale: 14)]
    private string $quote_currency_balance;
}
