<?php

namespace app;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Index;
use Doctrine\ORM\Mapping\UniqueConstraint;
use app\Enums\Period;

#[ORM\Entity(repositoryClass: CandleRepository::class)]
#[ORM\Table(name: 'candles')]
#[Index(name: "time_idx", columns: ["time"])]
#[UniqueConstraint(
    name: "currency_quote_currency_period_time_unique",
    columns: ["currency", "quote_currency", "period", "time"]
)]
class Candle
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id;

    #[ORM\Column(type: 'string')]
    private string $currency;

    #[ORM\Column(type: 'string')]
    private string $quote_currency;

    #[ORM\Column(type: 'string')]
    private string $period;

    #[ORM\Column(type: 'datetime')]
    private DateTime $time;

    #[ORM\Column(type: 'decimal', precision: 24, scale: 14)]
    private string $open;

    #[ORM\Column(type: 'decimal', precision: 24, scale: 14)]
    private string $close;

    #[ORM\Column(type: 'decimal', precision: 24, scale: 14)]
    private string $min;

    #[ORM\Column(type: 'decimal', precision: 24, scale: 14)]
    private string $max;

    #[ORM\Column(type: 'decimal', precision: 24, scale: 14)]
    private string $volume;

    #[ORM\Column(type: 'decimal', precision: 24, scale: 14)]
    private string $volume_quote;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setCurrency(string $currency): void
    {
        $this->currency = $currency;
    }
    public function setQuoteCurrency(string $quote_currency): void
    {
        $this->quote_currency = $quote_currency;
    }
    public function setPeriod(Period $period): void
    {
        $this->period = $period->name;
    }
    public function getTime(): DateTime
    {
        return $this->time;
    }
    public function setTime(DateTime $time): void
    {
        $this->time = $time;
    }
    public function setOpen(string $open): void
    {
        $this->open = $open;
    }
    public function setClose(string $close): void
    {
        $this->close = $close;
    }
    public function setMin(string $min): void
    {
        $this->min = $min;
    }
    public function setMax(string $max): void
    {
        $this->max = $max;
    }
    public function setVolume(string $volume): void
    {
        $this->volume = $volume;
    }
    public function setVolumeQuote(string $volume_quote): void
    {
        $this->volume_quote = $volume_quote;
    }
}
