<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\SocieteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SocieteRepository::class)]
#[ApiResource]
class Societe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\OneToMany(mappedBy: 'societe', targetEntity: NoteFrais::class)]
    private Collection $notesFrais;

    public function __construct()
    {
        $this->notesFrais = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * @return Collection<int, NoteFrais>
     */
    public function getNotesFrais(): Collection
    {
        return $this->notesFrais;
    }

    public function addNotesFrai(NoteFrais $notesFrai): static
    {
        if (!$this->notesFrais->contains($notesFrai)) {
            $this->notesFrais->add($notesFrai);
            $notesFrai->setSociete($this);
        }

        return $this;
    }

    public function removeNotesFrai(NoteFrais $notesFrai): static
    {
        if ($this->notesFrais->removeElement($notesFrai)) {
            // set the owning side to null (unless already changed)
            if ($notesFrai->getSociete() === $this) {
                $notesFrai->setSociete(null);
            }
        }

        return $this;
    }
}
