<?php

namespace app;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'balances')]
class Balance
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

    public function __construct(
        string $symbol,
        DateTime $date,
        string $currency_balance,
        string $quote_currency_balance
    ) {
        $this->symbol = $symbol;
        $this->date = $date;
        $this->currency_balance = $currency_balance;
        $this->quote_currency_balance = $quote_currency_balance;
    }
}
