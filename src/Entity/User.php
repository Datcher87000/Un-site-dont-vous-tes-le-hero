<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_EMAIL', fields: ['email'])]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180)]
    private ?string $email = null;

    /**
     * @var list<string> The user roles
     */
    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    private ?string $pseudo = null;

    /**
     * @var Collection<int, Hero>
     */
    #[ORM\OneToMany(targetEntity: Hero::class, mappedBy: 'utilisateur')]
    private Collection $heros;

    /**
     * @var Collection<int, Monstre>
     */
    #[ORM\OneToMany(targetEntity: Monstre::class, mappedBy: 'createur')]
    private Collection $monstre;

    /**
     * @var Collection<int, Histoire>
     */
    #[ORM\OneToMany(targetEntity: Histoire::class, mappedBy: 'createur')]
    private Collection $histoires;

    /**
     * @var Collection<int, Equipement>
     */
    #[ORM\OneToMany(targetEntity: Equipement::class, mappedBy: 'createur')]
    private Collection $equipements;

    public function __construct()
    {
        $this->heros = new ArrayCollection();
        $this->monstre = new ArrayCollection();
        $this->histoires = new ArrayCollection();
        $this->equipements = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     *
     * @return list<string>
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * @param list<string> $roles
     */
    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getPseudo(): ?string
    {
        return $this->pseudo;
    }

    public function setPseudo(string $pseudo): static
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    /**
     * @return Collection<int, Hero>
     */
    public function getHeros(): Collection
    {
        return $this->heros;
    }

    public function addHero(Hero $hero): static
    {
        if (!$this->heros->contains($hero)) {
            $this->heros->add($hero);
            $hero->setUtilisateur($this);
        }

        return $this;
    }

    public function removeHero(Hero $hero): static
    {
        if ($this->heros->removeElement($hero)) {
            // set the owning side to null (unless already changed)
            if ($hero->getUtilisateur() === $this) {
                $hero->setUtilisateur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Monstre>
     */
    public function getMonstre(): Collection
    {
        return $this->monstre;
    }

    public function addMonstre(Monstre $monstre): static
    {
        if (!$this->monstre->contains($monstre)) {
            $this->monstre->add($monstre);
            $monstre->setCreateur($this);
        }

        return $this;
    }

    public function removeMonstre(Monstre $monstre): static
    {
        if ($this->monstre->removeElement($monstre)) {
            // set the owning side to null (unless already changed)
            if ($monstre->getCreateur() === $this) {
                $monstre->setCreateur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Histoire>
     */
    public function getHistoires(): Collection
    {
        return $this->histoires;
    }

    public function addHistoire(Histoire $histoire): static
    {
        if (!$this->histoires->contains($histoire)) {
            $this->histoires->add($histoire);
            $histoire->setCreateur($this);
        }

        return $this;
    }

    public function removeHistoire(Histoire $histoire): static
    {
        if ($this->histoires->removeElement($histoire)) {
            // set the owning side to null (unless already changed)
            if ($histoire->getCreateur() === $this) {
                $histoire->setCreateur(null);
            }
        }

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
            $equipement->setCreateur($this);
        }

        return $this;
    }

    public function removeEquipement(Equipement $equipement): static
    {
        if ($this->equipements->removeElement($equipement)) {
            // set the owning side to null (unless already changed)
            if ($equipement->getCreateur() === $this) {
                $equipement->setCreateur(null);
            }
        }

        return $this;
    }
    public function __toString(): string
    {
        return $this->pseudo;
    }
}
