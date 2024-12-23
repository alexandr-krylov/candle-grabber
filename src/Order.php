<?php

namespace app;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;

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

    #[ManyToOne(targetEntity: Label::class)]
    #[JoinColumn(name: 'label_id', referencedColumnName: 'id')]
    private ?Label $label = null;
}