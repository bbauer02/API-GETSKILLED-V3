<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\ApiProperty;
use App\Entity\Embeddable\ContactInfo;
use App\Enum\CivilityEnum;
use App\Enum\GenderEnum;
use App\Enum\PlatformRoleEnum;
use App\Interfaces\Contactable;
use App\Repository\UserRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ApiResource(
    description: 'A user of the application, including login credentials and profile information.'
)]
class User implements Contactable
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

    #[ORM\Column(enumType: CivilityEnum::class)]
    #[ApiProperty(description: 'User civility (e.g., Mr, Mrs, Miss).')]
    private ?CivilityEnum $civility = null;

    #[ORM\Column(enumType: GenderEnum::class)]
    private ?GenderEnum $gender = null;

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
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\Column(enumType: PlatformRoleEnum::class)]
    private ?PlatformRoleEnum $platformRole = null;

    #[ORM\OneToOne(mappedBy: 'user', cascade: ['persist', 'remove'],  fetch: 'EAGER')]
    private ?InstituteMembership $instituteMembership = null;

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

    public function getCivility(): ?CivilityEnum
    {
        return $this->civility;
    }

    public function setCivility(CivilityEnum $civility): static
    {
        $this->civility = $civility;

        return $this;
    }

    public function getGender(): ?GenderEnum
    {
        return $this->gender;
    }

    public function setGender(GenderEnum $gender): static
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

    public function getNativeCountry(): ?string
    {
        return $this->nativeCountry->getName();
    }

    public function setNativeCountry(?Country $nativeCountry): static
    {
        $this->nativeCountry = $nativeCountry;

        return $this;
    }

    public function getNationality(): ?string
    {
        return $this->nationality->getDemonym();
    }

    public function setNationality(?Country $nationality): static
    {
        $this->nationality = $nationality;

        return $this;
    }

    public function getFirstlanguage(): ?string
    {
        return $this->firstlanguage->getLanguageName();
    }

    public function setFirstlanguage(?Country $firstlanguage): static
    {
        $this->firstlanguage = $firstlanguage;

        return $this;
    }

    public function getCountry(): string
    {
        return $this->country->getName();
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

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): static
    {
        $this->updateAt = $updatedAt;

        return $this;
    }

    public function getPlatformRole(): ?PlatformRoleEnum
    {
        return $this->platformRole;
    }

    public function setPlatformRole(PlatformRoleEnum $platformRole): static
    {
        $this->platformRole = $platformRole;

        return $this;
    }

    public function getName(): string
    {
        return $this->firstname . ' ' . $this->lastname;
    }

    public function getAddress1(): ?string
    {
       return $this->contactInfo->getAddress1();
    }
    public function setAddress1(string $address1): static
    {
        $this->contactInfo->setAddress1($address1);
        return $this;
    }
    public function getAddress2(): ?string
    {
        return $this->contactInfo->getAddress2();
    }

    public function setAddress2(string $address2): static
    {
        $this->contactInfo->setAddress2($address2);
        return $this;
    }

    public function getZipcode(): ?string
    {
        return $this->contactInfo->getZipcode();
    }

    public function setZipcode(string $zipcode): static
    {
        $this->contactInfo->setZipcode($zipcode);
        return $this;
    }
    public function getCity(): ?string
    {
        return $this->contactInfo->getCity();
    }

    public function setCity(string $city): static
    {
        $this->contactInfo->setCity($city);
        return $this;
    }

    public function getInstituteMembership(): ?InstituteMembership
    {
        return $this->instituteMembership;
    }

    public function setInstituteMembership(InstituteMembership $instituteMembership): static
    {
        // set the owning side of the relation if necessary
        if ($instituteMembership->getUser() !== $this) {
            $instituteMembership->setUser($this);
        }

        $this->instituteMembership = $instituteMembership;

        return $this;
    }
}
