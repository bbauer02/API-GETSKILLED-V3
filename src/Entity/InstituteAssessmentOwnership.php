<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Enum\OwnershipTypeEnum;
use App\Repository\InstituteAssessmentOwnershipRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InstituteAssessmentOwnershipRepository::class)]
#[ApiResource]
class InstituteAssessmentOwnership
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(enumType: OwnershipTypeEnum::class)]
    private ?OwnershipTypeEnum $ownershipType = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $purchaseDate = null;

    #[ORM\ManyToOne(inversedBy: 'instituteAssessmentOwnerships')]
    #[ORM\JoinColumn(nullable: false, onDelete: 'CASCADE')]
    private ?Institute $institute = null;

    #[ORM\ManyToOne(inversedBy: 'instituteAssessmentOwnerships')]
    #[ORM\JoinColumn(nullable: false, onDelete: 'CASCADE')]
    private ?Assessment $assessment = null;

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

    public function getInstitute(): ?Institute
    {
        return $this->institute;
    }

    public function setInstitute(?Institute $institute): static
    {
        $this->institute = $institute;

        return $this;
    }

    public function getAssessment(): ?Assessment
    {
        return $this->assessment;
    }

    public function setAssessment(?Assessment $assessment): static
    {
        $this->assessment = $assessment;

        return $this;
    }
}
