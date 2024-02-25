<?php

namespace app;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity]
#[ORM\Table(name: 'users')]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int|null $id = null;

    #[ORM\Column(type: 'string')]
    private string $name;

    #[ORM\OneToMany(targetEntity: Bug::class, mappedBy: 'reporter')]
    private Collection $reportedBugs;

    #[ORM\OneToMany(targetEntity: Bug::class, mappedBy: 'engineer')]
    private Collection $assignedBugs;

    public function __construct()
    {
        $this->reportedBugs = new ArrayCollection();
        $this->assignedBugs = new ArrayCollection();
    }
    
    public function getId(): int|null
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function addReportedBug(Bug $bug): void
    {
        $this->reportedBugs[] = $bug;
    }

    public function addAssignedBug(Bug $bug): void
    {
        $this->assignedBugs[] = $bug;
    }
}