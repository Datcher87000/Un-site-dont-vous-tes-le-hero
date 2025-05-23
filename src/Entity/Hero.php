<?php

namespace App\Entity;

use App\Repository\HeroRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: HeroRepository::class)]
class Hero
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: 'integer', options: ['default' => 10])]
    #[Assert\GreaterThanOrEqual(10)]
    private ?int $pv = 10;

    #[ORM\Column(type: 'integer', options: ['default' => 1])]
    #[Assert\GreaterThanOrEqual(1)]
    private ?int $atk = 1;

    #[ORM\Column(type: 'integer', options: ['default' => 1])]
    #[Assert\GreaterThanOrEqual(1)]
    private ?int $def = 1;

    #[ORM\Column(type: 'integer', options: ['default' => 1])]
    #[Assert\GreaterThanOrEqual(1)]
    private ?int $agi = 1;

    #[ORM\Column(type: 'integer', options: ['default' => 1])]
    #[Assert\GreaterThanOrEqual(1)]
    private ?int $intel = 1;

    public function validateStats(): bool
    {
        $totalPoints = ($this->def - 1) + ($this->atk - 1) + ($this->agi - 1) + ($this->intel - 1) + (int)(($this->pv - 10) / 5);

        return $totalPoints === 20;
    }
    #[ORM\ManyToOne(inversedBy: 'heros')]
    private ?User $utilisateur = null;

    /**
     * @var Collection<int, StatHero>
     */
    #[ORM\OneToMany(targetEntity: StatHero::class, mappedBy: 'hero', orphanRemoval: true)]
    private Collection $statHeroes;

    public function __construct()
    {
        $this->statHeroes = new ArrayCollection();
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

    public function getPv(): ?int
    {
        return $this->pv;
    }

    public function setPv(int $pv): static
    {
        $this->pv = $pv;

        return $this;
    }

    public function getAtk(): ?int
    {
        return $this->atk;
    }

    public function setAtk(int $atk): static
    {
        $this->atk = $atk;

        return $this;
    }

    public function getDef(): ?int
    {
        return $this->def;
    }

    public function setDef(int $def): static
    {
        $this->def = $def;

        return $this;
    }

    public function getAgi(): ?int
    {
        return $this->agi;
    }

    public function setAgi(int $agi): static
    {
        $this->agi = $agi;

        return $this;
    }

    public function getIntel(): ?int
    {
        return $this->intel;
    }

    public function setIntel(int $intel): static
    {
        $this->intel = $intel;

        return $this;
    }

    public function getUtilisateur(): ?User
    {
        return $this->utilisateur;
    }

    public function setUtilisateur(?User $utilisateur): static
    {
        $this->utilisateur = $utilisateur;

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
            $statHero->setHero($this);
        }

        return $this;
    }

    public function removeStatHero(StatHero $statHero): static
    {
        if ($this->statHeroes->removeElement($statHero)) {
            // set the owning side to null (unless already changed)
            if ($statHero->getHero() === $this) {
                $statHero->setHero(null);
            }
        }

        return $this;
    }
}
