<?php

namespace App\Entity;

use App\Repository\ChoixRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ChoixRepository::class)]
class Choix
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(nullable: true)]
    private ?int $chapitreCible = null;

    #[ORM\ManyToOne(inversedBy: 'choix')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Chapitre $chapitre = null;

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

    public function getChapitreCible(): ?int
    {
        return $this->chapitreCible;
    }

    public function setChapitreCible(int $chapitreCible): static
    {
        $this->chapitreCible = $chapitreCible;

        return $this;
    }

    public function getChapitre(): ?Chapitre
    {
        return $this->chapitre;
    }

    public function setChapitre(?Chapitre $chapitre): static
    {
        $this->chapitre = $chapitre;

        return $this;
    }

    public function getChapitreCibleEntity(): ?Chapitre
    {
        return $this->chapitreCible ? $this->chapitre->getHistoire()->getChapitreByNumChapitre($this->chapitreCible) : null;
    }
}
