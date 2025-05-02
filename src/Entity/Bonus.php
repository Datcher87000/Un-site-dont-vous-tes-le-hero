<?php

namespace App\Entity;

use App\Repository\BonusRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BonusRepository::class)]
class Bonus
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?int $bonusPV = null;

    #[ORM\Column(nullable: true)]
    private ?int $bonusAtk = null;

    #[ORM\Column(nullable: true)]
    private ?int $bonusDef = null;

    #[ORM\Column(nullable: true)]
    private ?int $bonusAgi = null;

    #[ORM\Column(nullable: true)]
    private ?int $bonusInt = null;

    /**
     * @var Collection<int, Chapitre>
     */
    #[ORM\ManyToMany(targetEntity: Chapitre::class, mappedBy: 'bonus')]
    private Collection $chapitres;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    public function __construct()
    {
        $this->chapitres = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBonusPV(): ?int
    {
        return $this->bonusPV;
    }

    public function setBonusPV(?int $bonusPV): static
    {
        $this->bonusPV = $bonusPV;

        return $this;
    }

    public function getBonusAtk(): ?int
    {
        return $this->bonusAtk;
    }

    public function setBonusAtk(?int $bonusAtk): static
    {
        $this->bonusAtk = $bonusAtk;

        return $this;
    }

    public function getBonusDef(): ?int
    {
        return $this->bonusDef;
    }

    public function setBonusDef(?int $bonusDef): static
    {
        $this->bonusDef = $bonusDef;

        return $this;
    }

    public function getBonusAgi(): ?int
    {
        return $this->bonusAgi;
    }

    public function setBonusAgi(?int $bonusAgi): static
    {
        $this->bonusAgi = $bonusAgi;

        return $this;
    }

    public function getBonusInt(): ?int
    {
        return $this->bonusInt;
    }

    public function setBonusInt(?int $bonusInt): static
    {
        $this->bonusInt = $bonusInt;

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
            $chapitre->addBonu($this);
        }

        return $this;
    }

    public function removeChapitre(Chapitre $chapitre): static
    {
        if ($this->chapitres->removeElement($chapitre)) {
            $chapitre->removeBonu($this);
        }

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }
}
