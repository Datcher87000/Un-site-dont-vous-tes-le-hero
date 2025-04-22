<?php

namespace App\Entity;

use App\Repository\StatHeroRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StatHeroRepository::class)]
class StatHero
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?int $pvActu = null;

    #[ORM\Column(nullable: true)]
    private ?int $atkActu = null;

    #[ORM\Column(nullable: true)]
    private ?int $defActu = null;

    #[ORM\Column(nullable: true)]
    private ?int $agiActu = null;

    #[ORM\Column(nullable: true)]
    private ?int $intActu = null;

    #[ORM\ManyToOne(inversedBy: 'statHeroes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Hero $hero = null;

    #[ORM\ManyToOne(inversedBy: 'statHeroes')]
    private ?Histoire $histoire = null;

    /**
     * @var Collection<int, Equipement>
     */
    #[ORM\ManyToMany(targetEntity: Equipement::class, mappedBy: 'statHero')]
    private Collection $equipements;

    public function __construct()
    {
        $this->equipements = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPvActu(): ?int
    {
        return $this->pvActu;
    }

    public function setPvActu(?int $pvActu): static
    {
        $this->pvActu = $pvActu;

        return $this;
    }

    public function getAtkActu(): ?int
    {
        return $this->atkActu;
    }

    public function setAtkActu(?int $atkActu): static
    {
        $this->atkActu = $atkActu;

        return $this;
    }

    public function getDefActu(): ?int
    {
        return $this->defActu;
    }

    public function setDefActu(?int $defActu): static
    {
        $this->defActu = $defActu;

        return $this;
    }

    public function getAgiActu(): ?int
    {
        return $this->agiActu;
    }

    public function setAgiActu(?int $agiActu): static
    {
        $this->agiActu = $agiActu;

        return $this;
    }

    public function getIntActu(): ?int
    {
        return $this->intActu;
    }

    public function setIntActu(?int $intActu): static
    {
        $this->intActu = $intActu;

        return $this;
    }

    public function getHero(): ?Hero
    {
        return $this->hero;
    }

    public function setHero(?Hero $hero): static
    {
        $this->hero = $hero;

        return $this;
    }

    public function getHistoire(): ?Histoire
    {
        return $this->histoire;
    }

    public function setHistoire(?Histoire $histoire): static
    {
        $this->histoire = $histoire;

        return $this;
    }

    /**
     * @return Collection<int, Equipement>
     */
    public function getEquipements(): Collection
    {
        return $this->equipements;
    }

    public function addEquipement(Equipement $equipement): static
    {
        if (!$this->equipements->contains($equipement)) {
            $this->equipements->add($equipement);
            $equipement->addStatHero($this);
        }

        return $this;
    }

    public function removeEquipement(Equipement $equipement): static
    {
        if ($this->equipements->removeElement($equipement)) {
            $equipement->removeStatHero($this);
        }

        return $this;
    }
}
