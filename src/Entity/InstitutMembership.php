<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Enum\InstitutRoleEnum;
use App\Repository\InstitutMembershipRepository;
use DateTimeImmutable;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InstitutMembershipRepository::class)]
#[ApiResource]
class InstitutMembership
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(enumType: InstitutRoleEnum::class)]
    private ?InstitutRoleEnum $role = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?DateTimeImmutable $since = null;

    #[ORM\OneToOne(inversedBy: 'institutMembership', cascade: ['persist'], orphanRemoval: true)]
    #[ORM\JoinColumn(nullable: false, onDelete: 'CASCADE')]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'institutMemberships', cascade: ['persist'])]
    #[ORM\JoinColumn(nullable: false,  onDelete: 'CASCADE')]
    private ?institut $institut = null;


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

    public function getInstitut(): ?institut
    {
        return $this->institut;
    }

    public function setInstitut(?institut $institut): static
    {
        $this->institut = $institut;

        return $this;
    }
}
