<?php

namespace app;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    #[ORM\ManyToMany(targetEntity: Label::class, mappedBy: 'balances')]
    private Collection $labels;

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
        $this->labels = new ArrayCollection();
    }
    public function getId(): ?int
    {
        return $this->id;
    }
    public function getSymbol(): ?string
    {
        return $this->symbol;
    }
    public function getDate(): DateTime
    {
        return $this->date;
    }
    public function getCurrencyBalance(): string
    {
        return $this->currency_balance;
    }
    public function getQuoteCurrencyBalance(): string
    {
        return $this->quote_currency_balance;
    }
}
