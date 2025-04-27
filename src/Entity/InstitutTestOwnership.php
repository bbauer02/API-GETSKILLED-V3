<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Enum\OwnershipTypeEnum;
use App\Repository\InstitutTestOwnershipRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InstitutTestOwnershipRepository::class)]
#[ApiResource]
class InstitutTestOwnership
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(enumType: OwnershipTypeEnum::class)]
    private ?OwnershipTypeEnum $ownershipType = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $purchaseDate = null;

    //#[ORM\ManyToOne(inversedBy: 'institutTestOwnerships')]
    //#[ORM\JoinColumn(nullable: false, onDelete: 'CASCADE')]
    //private ?Test $test = null;

    #[ORM\ManyToOne(inversedBy: 'institutTestOwnerships')]
    #[ORM\JoinColumn(nullable: false, onDelete: 'CASCADE')]
    private ?Institut $institut = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOwnershipType(): ?OwnershipTypeEnum
    {
        return $this->ownershipType;
    }

    public function setOwnershipType(OwnershipTypeEnum $ownershipType): static
    {
        $this->ownershipType = $ownershipType;

        return $this;
    }

    public function getPurchaseDate(): ?\DateTimeInterface
    {
        return $this->purchaseDate;
    }

    public function setPurchaseDate(\DateTimeInterface $purchaseDate): static
    {
        $this->purchaseDate = $purchaseDate;

        return $this;
    }

    public function getTest(): ?Test
    {
        return $this->test;
    }

    public function setTest(?Test $test): static
    {
        $this->test = $test;

        return $this;
    }

    public function getInstitut(): ?Institut
    {
        return $this->institut;
    }

    public function setInstitut(?Institut $institut): static
    {
        $this->institut = $institut;

        return $this;
    }
}
