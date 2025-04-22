<?php

namespace App\Entity;

use App\Repository\EquipementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EquipementRepository::class)]
class Equipement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    /**
     * @var Collection<int, Chapitre>
     */
    #[ORM\ManyToMany(targetEntity: Chapitre::class, mappedBy: 'equipements')]
    private Collection $chapitres;

    /**
     * @var Collection<int, Enchantement>
     */
    #[ORM\ManyToMany(targetEntity: Enchantement::class, inversedBy: 'equipements')]
    private Collection $enchantements;

    /**
     * @var Collection<int, StatHero>
     */
    #[ORM\ManyToMany(targetEntity: StatHero::class, inversedBy: 'equipements')]
    private Collection $statHero;

    #[ORM\ManyToOne(inversedBy: 'equipements')]
    private ?User $createur = null;

    #[ORM\ManyToOne(inversedBy: 'equipements')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Emplacement $emplacement = null;

    public function __construct()
    {
        $this->chapitres = new ArrayCollection();
        $this->enchantements = new ArrayCollection();
        $this->statHero = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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
            $chapitre->addEquipement($this);
        }

        return $this;
    }

    public function removeChapitre(Chapitre $chapitre): static
    {
        if ($this->chapitres->removeElement($chapitre)) {
            $chapitre->removeEquipement($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Enchantement>
     */
    public function getEnchantements(): Collection
    {
        return $this->enchantements;
    }

    public function addEnchantement(Enchantement $enchantement): static
    {
        if (!$this->enchantements->contains($enchantement)) {
            $this->enchantements->add($enchantement);
        }

        return $this;
    }

    public function removeEnchantement(Enchantement $enchantement): static
    {
        $this->enchantements->removeElement($enchantement);

        return $this;
    }

    /**
     * @return Collection<int, StatHero>
     */
    public function getStatHero(): Collection
    {
        return $this->statHero;
    }

    public function addStatHero(StatHero $statHero): static
    {
        if (!$this->statHero->contains($statHero)) {
            $this->statHero->add($statHero);
        }

        return $this;
    }

    public function removeStatHero(StatHero $statHero): static
    {
        $this->statHero->removeElement($statHero);

        return $this;
    }

    public function getCreateur(): ?User
    {
        return $this->createur;
    }

    public function setCreateur(?User $createur): static
    {
        $this->createur = $createur;

        return $this;
    }

    public function getEmplacement(): ?Emplacement
    {
        return $this->emplacement;
    }

    public function setEmplacement(?Emplacement $emplacement): static
    {
        $this->emplacement = $emplacement;

        return $this;
    }
}
