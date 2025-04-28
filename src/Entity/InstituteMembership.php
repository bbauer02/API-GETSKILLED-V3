<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Enum\InstituteRoleEnum;
use App\Repository\InstituteMembershipRepository;
use DateTimeImmutable;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InstituteMembershipRepository::class)]
#[ApiResource]
class InstituteMembership
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(enumType: InstituteRoleEnum::class)]
    private ?InstituteRoleEnum $role = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?DateTimeImmutable $since = null;

    #[ORM\OneToOne(inversedBy: 'instituteMembership', cascade: ['persist'], orphanRemoval: true)]
    #[ORM\JoinColumn(nullable: false, onDelete: 'CASCADE')]
    private ?User $user = null;

    #[ORM\ManyToOne(cascade: ['persist'], inversedBy: 'instituteMemberships')]
    #[ORM\JoinColumn(nullable: false,  onDelete: 'CASCADE')]
    private ?Institute $institute = null;


    public function __construct()
    {
        $this->since = new DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRole(): ?InstitutRoleEnum
    {
        return $this->role;
    }

    public function setRole(InstitutRoleEnum $role): static
    {
        $this->role = $role;

        return $this;
    }

    public function getSince(): ?\DateTimeImmutable
    {
        return $this->since;
    }

    public function setSince(\DateTimeImmutable  $since): static
    {
        $this->since = $since;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getInstitute(): ?institute
    {
        return $this->institute;
    }

    public function setInstitute(?Institute $institute): static
    {
        $this->institute = $institute;

        return $this;
    }
}
