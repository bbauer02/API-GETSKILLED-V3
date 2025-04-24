<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\CountryRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CountryRepository::class)]
#[ApiResource]
class Country
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $demonym = null;

    #[ORM\Column(length: 255)]
    private ?string $languageName = null;

    #[ORM\Column(type: 'string', unique: true, length: 3)]
    private ?string $isoCode = null;

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

    public function getDemonym(): ?string
    {
        return $this->demonym;
    }

    public function setDemonym(?string $demonym): static
    {
        $this->demonym = $demonym;

        return $this;
    }

    public function getLanguageName(): ?string
    {
        return $this->languageName;
    }

    public function setLanguageName(string $languageName): static
    {
        $this->languageName = $languageName;

        return $this;
    }

    public function getIsoCode(): ?string
    {
        return $this->isoCode;
    }

    public function setIsoCode(string $isoCode): static
    {
        $this->isoCode = $isoCode;

        return $this;
    }
}
