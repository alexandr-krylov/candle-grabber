<?php

namespace app;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity]
#[ORM\Table(name: 'labels')]
class Label
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id;

    #[ORM\Column(type: 'datetime')]
    private DateTime $startedAt;

    #[ORM\Column(type: 'datetime')]
    private DateTime $endedAt;

    #[ORM\Column(type: 'string', length: 255)]
    private string $symbol;

    #[ORM\Column(type: 'string', length: 255)]
    private string $period;

    #[ORM\Column(type: 'datetime')]
    private DateTime $createdAt;

    #[ORM\ManyToMany(targetEntity: Balance::class, inversedBy: 'labels')]
    #[ORM\JoinTable(name: 'labels_balances')]
    private Collection $balances;

    #[ORM\ManyToMany(targetEntity: Order::class, inversedBy: 'labels')]
    #[ORM\JoinTable(name: 'labels_orders')]
    private Collection $orders;

    public function __construct(
        DateTime $startedAt,
        DateTime $endedAt,
        string $symbol,
        string $period
    ) {
        $this->startedAt = $startedAt;
        $this->endedAt = $endedAt;
        $this->symbol = $symbol;
        $this->period = $period;
        $this->createdAt = new DateTime();
        $this->balances = new ArrayCollection();
        $this->orders = new ArrayCollection();
    }

    public function addBalance(Balance $balance): void
    {
        if (!$this->balances->contains($balance)) {
            $this->balances[] = $balance;
        }
    }

    public function addOrder(Order $order): void
    {
        if (!$this->orders->contains($order)) {
            $this->orders[] = $order;
        }
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStartedAt(): DateTime
    {
        return $this->startedAt;
    }

    public function setStartedAt(DateTime $startedAt): void
    {
        $this->startedAt = $startedAt;
    }

    public function getEndedAt(): DateTime
    {
        return $this->endedAt;
    }
}
