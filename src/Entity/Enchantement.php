<?php

namespace App\Entity;

use App\Repository\EnchantementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EnchantementRepository::class)]
class Enchantement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?int $bonusPv = null;

    #[ORM\Column(nullable: true)]
    private ?int $bonusAtk = null;

    #[ORM\Column(nullable: true)]
    private ?int $bonusDef = null;

    #[ORM\Column(nullable: true)]
    private ?int $bonusAgi = null;

    #[ORM\Column(nullable: true)]
    private ?int $bonusInt = null;

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
     * @var Collection<int, Equipement>
     */
    #[ORM\ManyToMany(targetEntity: Equipement::class, mappedBy: 'enchantements')]
    private Collection $equipements;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    public function __construct()
    {
        $this->equipements = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBonusPv(): ?int
    {
        return $this->bonusPv;
    }

    public function setBonusPv(int $bonusPv): static
    {
        $this->bonusPv = $bonusPv;

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
            $equipement->addEnchantement($this);
        }

        return $this;
    }

    public function removeEquipement(Equipement $equipement): static
    {
        if ($this->equipements->removeElement($equipement)) {
            $equipement->removeEnchantement($this);
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
    public function applyToStatHero(StatHero $statHero): void
    {
        $statHero->setPvActu($statHero->getPvActu() + $this->bonusPv - $this->malusPv);
        $statHero->setAtkActu($statHero->getAtkActu() + $this->bonusAtk - $this->malusAtk);
        $statHero->setDefActu($statHero->getDefActu() + $this->bonusDef - $this->malusDef);
        $statHero->setAgiActu($statHero->getAgiActu() + $this->bonusAgi - $this->malusAgi);
        $statHero->setIntActu($statHero->getIntActu() + $this->bonusInt - $this->malusInt);
    }

    public function removeFromStatHero(StatHero $statHero): void
    {
        $statHero->setPvActu($statHero->getPvActu() - $this->bonusPv + $this->malusPv);
        $statHero->setAtkActu($statHero->getAtkActu() - $this->bonusAtk + $this->malusAtk);
        $statHero->setDefActu($statHero->getDefActu() - $this->bonusDef + $this->malusDef);
        $statHero->setAgiActu($statHero->getAgiActu() - $this->bonusAgi + $this->malusAgi);
        $statHero->setIntActu($statHero->getIntActu() - $this->bonusInt + $this->malusInt);
    }
}
