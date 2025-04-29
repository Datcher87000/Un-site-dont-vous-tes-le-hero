<?php

namespace App\Entity;

use App\Repository\ChapitreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ChapitreRepository::class)]
class Chapitre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\Column]
    private ?int $numChapitre = null;

    #[ORM\ManyToOne(inversedBy: 'chapitres')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Histoire $histoire = null;

    /**
     * @var Collection<int, Monstre>
     */
    #[ORM\ManyToMany(targetEntity: Monstre::class, inversedBy: 'chapitres')]
    private Collection $monstres;

    /**
     * @var Collection<int, Bonus>
     */
    #[ORM\ManyToMany(targetEntity: Bonus::class, inversedBy: 'chapitres')]
    private Collection $bonus;

    /**
     * @var Collection<int, Malus>
     */
    #[ORM\ManyToMany(targetEntity: Malus::class, inversedBy: 'chapitres')]
    private Collection $malus;

    /**
     * @var Collection<int, Equipement>
     */
    #[ORM\ManyToMany(targetEntity: Equipement::class, inversedBy: 'chapitres')]
    private Collection $equipements;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?StatHero $statHero = null;

    /**
     * @var Collection<int, Choix>
     */
   #[ORM\OneToMany(targetEntity: Choix::class, mappedBy: 'chapitre', cascade: ['persist', 'remove'], orphanRemoval: true)]
   private Collection $choix;

    #[ORM\Column(length: 255)]
    private ?string $titre = null;

    public function __construct()
    {
        $this->monstres = new ArrayCollection();
        $this->bonus = new ArrayCollection();
        $this->malus = new ArrayCollection();
        $this->equipements = new ArrayCollection();
        $this->choix = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getNumChapitre(): ?int
    {
        return $this->numChapitre;
    }

    public function setNumChapitre(int $numChapitre): static
    {
        $this->numChapitre = $numChapitre;

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
     * @return Collection<int, Monstre>
     */
    public function getMonstres(): Collection
    {
        return $this->monstres;
    }

    public function addMonstre(Monstre $monstre): static
    {
        if (!$this->monstres->contains($monstre)) {
            $this->monstres->add($monstre);
        }

        return $this;
    }

    public function removeMonstre(Monstre $monstre): static
    {
        $this->monstres->removeElement($monstre);

        return $this;
    }

    /**
     * @return Collection<int, Bonus>
     */
    public function getBonus(): Collection
    {
        return $this->bonus;
    }

    public function addBonu(Bonus $bonu): static
    {
        if (!$this->bonus->contains($bonu)) {
            $this->bonus->add($bonu);
        }

        return $this;
    }

    public function removeBonu(Bonus $bonu): static
    {
        $this->bonus->removeElement($bonu);

        return $this;
    }

    /**
     * @return Collection<int, Malus>
     */
    public function getMalus(): Collection
    {
        return $this->malus;
    }

    public function addMalu(Malus $malu): static
    {
        if (!$this->malus->contains($malu)) {
            $this->malus->add($malu);
        }

        return $this;
    }

    public function removeMalu(Malus $malu): static
    {
        $this->malus->removeElement($malu);

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
        }

        return $this;
    }

    public function removeEquipement(Equipement $equipement): static
    {
        $this->equipements->removeElement($equipement);

        return $this;
    }

    public function getStatHero(): ?StatHero
    {
        return $this->statHero;
    }

    public function setStatHero(?StatHero $statHero): static
    {
        $this->statHero = $statHero;

        return $this;
    }

    /**
     * @return Collection<int, Choix>
     */
    public function getChoix(): Collection
    {
        return $this->choix;
    }

    public function addChoix(Choix $choix): static
    {
        if (!$this->choix->contains($choix)) {
            $this->choix->add($choix);
            $choix->setChapitre($this);
        }

        return $this;
    }

    public function removeChoix(Choix $choix): static
    {
        if ($this->choix->removeElement($choix)) {
            // set the owning side to null (unless already changed)
            if ($choix->getChapitre() === $this) {
                $choix->setChapitre(null);
            }
        }

        return $this;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $Titre): static
    {
        $this->titre = $Titre;

        return $this;
    }
}
