<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\ApiProperty;
use App\Entity\Embeddable\ContactInfo;
use App\Enum\Civility;
use App\Enum\Gender;
use App\Repository\UserRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ApiResource(
    description: 'A user of the application, including login credentials and profile information.'
)]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $avatar = null;

    #[ORM\Column(length: 255)]
    private ?string $login = null;

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    #[ORM\Column(enumType: Civility::class)]
    #[ApiProperty(description: 'User civility (e.g., Mr, Mrs, Miss).')]
    private ?Civility $civility = null;

    #[ORM\Column(enumType: Gender::class)]
    private ?Gender $gender = null;

    #[ORM\Column(length: 255)]
    private ?string $firstname = null;

    #[ORM\Column(length: 255)]
    private ?string $lastname = null;

    #[ORM\Embedded(class: ContactInfo::class, columnPrefix: 'contact_')]
    private ?ContactInfo $contactInfo = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $birthday = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Country $nativeCountry = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Country $nationality = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Country $firstlanguage = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Country $country = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $previousRegistrationNumber = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updateAt = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAvatar(): ?string
    {
        return $this->avatar;
    }

    public function setAvatar(string $avatar): static
    {
        $this->avatar = $avatar;

        return $this;
    }

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(string $login): static
    {
        $this->login = $login;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function getCivility(): ?Civility
    {
        return $this->civility;
    }

    public function setCivility(Civility $civility): static
    {
        $this->civility = $civility;

        return $this;
    }

    public function getGender(): ?Gender
    {
        return $this->gender;
    }

    public function setGender(Gender $gender): static
    {
        $this->gender = $gender;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): static
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): static
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getBirthday(): ?\DateTimeInterface
    {
        return $this->birthday;
    }

    public function setBirthday(\DateTimeInterface $birthday): static
    {
        $this->birthday = $birthday;

        return $this;
    }

    public function getNativeCountry(): ?Country
    {
        return $this->nativeCountry;
    }

    public function setNativeCountry(?Country $nativeCountry): static
    {
        $this->nativeCountry = $nativeCountry;

        return $this;
    }

    public function getNationality(): ?Country
    {
        return $this->nationality;
    }

    public function setNationality(?Country $nationality): static
    {
        $this->nationality = $nationality;

        return $this;
    }

    public function getFirstlanguage(): ?Country
    {
        return $this->firstlanguage;
    }

    public function setFirstlanguage(?Country $firstlanguage): static
    {
        $this->firstlanguage = $firstlanguage;

        return $this;
    }

    public function getCountry(): ?Country
    {
        return $this->country;
    }

    public function setCountry(?Country $country): static
    {
        $this->country = $country;

        return $this;
    }

    public function getPreviousRegistrationNumber(): ?string
    {
        return $this->previousRegistrationNumber;
    }

    public function setPreviousRegistrationNumber(?string $previousRegistrationNumber): static
    {
        $this->previousRegistrationNumber = $previousRegistrationNumber;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdateAt(): ?\DateTimeImmutable
    {
        return $this->updateAt;
    }

    public function setUpdateAt(\DateTimeImmutable $updateAt): static
    {
        $this->updateAt = $updateAt;

        return $this;
    }
}
