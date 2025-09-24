<?php

namespace app;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'orders')]
class Order
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id;

    #[ORM\Column(type: 'string')]
    private string $symbol;

    #[ORM\Column(type: 'string')]
    private string $side;

    #[ORM\Column(type: 'decimal', precision: 24, scale: 14)]
    private string $price;

    #[ORM\Column(type: 'decimal', precision: 24, scale: 14)]
    private string $quantity;

    #[ORM\Column(type: 'decimal', precision: 24, scale: 14)]
    private string $quantityCumalative;

    #[ORM\Column(type: 'datetime')]
    private DateTime $time;

    #[ORM\ManyToMany(targetEntity: Label::class, mappedBy: 'orders')]
    private Collection $labels;

    public function __construct(
        string $symbol,
        string $side,
        string $price,
        string $quantity,
        string $quantityCumalative,
        DateTime $time
    ) {
        $this->symbol = $symbol;
        $this->side = $side;
        $this->price = $price;
        $this->quantity = $quantity;
        $this->quantityCumalative = $quantityCumalative;
        $this->time = $time;
        $this->labels = new ArrayCollection();
    }
}
