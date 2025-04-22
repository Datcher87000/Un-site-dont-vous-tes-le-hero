<?php

namespace App\Entity;

use App\Repository\HistoireRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HistoireRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Histoire
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titre = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'histoires')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $createur = null;

    /**
     * @var Collection<int, StatHero>
     */
    #[ORM\OneToMany(targetEntity: StatHero::class, mappedBy: 'histoire')]
    private Collection $statHeroes;

    /**
     * @var Collection<int, Chapitre>
     */
    #[ORM\OneToMany(targetEntity: Chapitre::class, mappedBy: 'histoire', orphanRemoval: true)]
    private Collection $chapitres;

    public function __construct()
    {
        $this->statHeroes = new ArrayCollection();
        $this->chapitres = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): static
    {
        $this->titre = $titre;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    #[ORM\PrePersist]
    public function setCreatedAt(): static
    {
        $this->createdAt = new \DateTimeImmutable();

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

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

    /**
     * @return Collection<int, StatHero>
     */
    public function getStatHeroes(): Collection
    {
        return $this->statHeroes;
    }

    public function addStatHero(StatHero $statHero): static
    {
        if (!$this->statHeroes->contains($statHero)) {
            $this->statHeroes->add($statHero);
            $statHero->setHistoire($this);
        }

        return $this;
    }

    public function removeStatHero(StatHero $statHero): static
    {
        if ($this->statHeroes->removeElement($statHero)) {
            // set the owning side to null (unless already changed)
            if ($statHero->getHistoire() === $this) {
                $statHero->setHistoire(null);
            }
        }

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
            $chapitre->setHistoire($this);
        }

        return $this;
    }

    public function removeChapitre(Chapitre $chapitre): static
    {
        if ($this->chapitres->removeElement($chapitre)) {
            // set the owning side to null (unless already changed)
            if ($chapitre->getHistoire() === $this) {
                $chapitre->setHistoire(null);
            }
        }

        return $this;
    }
}
