<?php

namespace App\Entity;

use App\Repository\ExtranetRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ExtranetRepository::class)]
class Extranet
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $nom;

    #[ORM\ManyToMany(targetEntity: Compte::class, inversedBy: 'extranets')]
    private $compte;

    public function __construct()
    {
        $this->compte = new ArrayCollection();
    }
    public function __toString()
    {
        return $this->getNom();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * @return Collection<int, Compte>
     */
    public function getCompte(): Collection
    {
        return $this->compte;
    }

    public function addCompte(Compte $compte): self
    {
        if (!$this->compte->contains($compte)) {
            $this->compte[] = $compte;
        }

        return $this;
    }

    public function removeCompte(Compte $compte): self
    {
        $this->compte->removeElement($compte);

        return $this;
    }
}
