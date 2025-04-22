<?php

namespace App\Entity;

use App\Repository\MalusRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MalusRepository::class)]
class Malus
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?int $malusPv = null;

    #[ORM\Column(nullable: true)]
    private ?int $malusAtk = null;

    #[ORM\Column(nullable: true)]
    private ?int $malusDef = null;

    #[ORM\Column(nullable: true)]
    private ?int $malusAgi = null;

    #[ORM\Column(nullable: true)]
    private ?int $malusInt = null;

    /**
     * @var Collection<int, Chapitre>
     */
    #[ORM\ManyToMany(targetEntity: Chapitre::class, mappedBy: 'malus')]
    private Collection $chapitres;

    public function __construct()
    {
        $this->chapitres = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMalusPv(): ?int
    {
        return $this->malusPv;
    }

    public function setMalusPv(?int $malusPv): static
    {
        $this->malusPv = $malusPv;

        return $this;
    }

    public function getMalusAtk(): ?int
    {
        return $this->malusAtk;
    }

    public function setMalusAtk(?int $malusAtk): static
    {
        $this->malusAtk = $malusAtk;

        return $this;
    }

    public function getMalusDef(): ?int
    {
        return $this->malusDef;
    }

    public function setMalusDef(?int $malusDef): static
    {
        $this->malusDef = $malusDef;

        return $this;
    }

    public function getMalusAgi(): ?int
    {
        return $this->malusAgi;
    }

    public function setMalusAgi(?int $malusAgi): static
    {
        $this->malusAgi = $malusAgi;

        return $this;
    }

    public function getMalusInt(): ?int
    {
        return $this->malusInt;
    }

    public function setMalusInt(?int $malusInt): static
    {
        $this->malusInt = $malusInt;

        return $this;
    }

    /**
     * @return Collection<int, Chapitre>
     */
    public function getChapitres(): Collection
    {
        return $this->chapitres;
    }

    public function addChapitre(Chapitre $chapitre): static
    {
        if (!$this->chapitres->contains($chapitre)) {
            $this->chapitres->add($chapitre);
            $chapitre->addMalu($this);
        }

        return $this;
    }

    public function removeChapitre(Chapitre $chapitre): static
    {
        if ($this->chapitres->removeElement($chapitre)) {
            $chapitre->removeMalu($this);
        }

        return $this;
    }
}
