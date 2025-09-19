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
