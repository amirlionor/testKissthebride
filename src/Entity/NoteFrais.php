<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Controller\NoteFraisController;
use App\Repository\NoteFraisRepository;
use Doctrine\DBAL\Types\Types;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Put;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NoteFraisRepository::class)]
#[ApiResource(
    operations: [
        new Get(name: 'app_note_frais_all', uriTemplate: 'api/notefrais/getall', controller: NoteFraisController::class),
        new Get(name: 'app_note_frais_get', uriTemplate: 'api/notefrais/get/{id}', controller: NoteFraisController::class),
        new POST(name: 'app_note_frais_create', uriTemplate: 'api/notefrais/create', controller: NoteFraisController::class),
        new PUT(name: 'app_note_frais_update', uriTemplate: 'api/notefrais/update/{id}', controller: NoteFraisController::class),
        new DELETE(name: 'app_note_frais_delete', uriTemplate: 'api/notefrais/delete/{id}', controller: NoteFraisController::class),
    ]
)]
class NoteFrais
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateNote = null;

    #[ORM\Column]
    private ?float $montantNote = null;

    #[ORM\Column(length: 255)]
    private ?string $typeNote = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateEnregistrement = null;

    #[ORM\ManyToOne(inversedBy: 'notesFrais')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Societe $societe = null;

    #[ORM\ManyToOne(inversedBy: 'notesFrais')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateNote(): ?\DateTimeInterface
    {
        return $this->dateNote;
    }

    public function setDateNote(\DateTimeInterface $dateNote): static
    {
        $this->dateNote = $dateNote;

        return $this;
    }

    public function getMontantNote(): ?float
    {
        return $this->montantNote;
    }

    public function setMontantNote(float $montantNote): static
    {
        $this->montantNote = $montantNote;

        return $this;
    }

    public function getTypeNote(): ?string
    {
        return $this->typeNote;
    }

    public function setTypeNote(string $typeNote): static
    {
        $this->typeNote = $typeNote;

        return $this;
    }

    public function getDateEnregistrement(): ?\DateTimeInterface
    {
        return $this->dateEnregistrement;
    }

    public function setDateEnregistrement(\DateTimeInterface $dateEnregistrement): static
    {
        $this->dateEnregistrement = $dateEnregistrement;

        return $this;
    }

    public function getSociete(): ?Societe
    {
        return $this->societe;
    }

    public function setSociete(?Societe $societe): static
    {
        $this->societe = $societe;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }
}
