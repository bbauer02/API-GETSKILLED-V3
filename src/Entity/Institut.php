<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Entity\Embeddable\ContactInfo;
use App\Interfaces\Contactable;
use App\Repository\InstitutRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InstitutRepository::class)]
#[ApiResource]
class Institut implements Contactable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $label = null;
    #[ORM\Embedded(class: ContactInfo::class, columnPrefix: 'contact_')]
    private ?ContactInfo $contactInfo = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $siteweb = null;

    #[ORM\Column(nullable: true)]
    private ?array $socialNetworks = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Country $country = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?StripeAccount $stripeAccount = null;

    /**
     * @var Collection<int, InstitutMembership>
     */
    #[ORM\OneToMany(targetEntity: InstitutMembership::class, mappedBy: 'institut', cascade: ['persist', 'remove'], orphanRemoval: true)]
    private Collection $institutMemberships;

    #[ORM\Column(length: 15, nullable: true)]
    private ?string $phone = null;

    /**
     * @var Collection<int, InstitutTestOwnership>
     */
    #[ORM\OneToMany(targetEntity: InstitutTestOwnership::class, mappedBy: 'institut', cascade: ['persist', 'remove'], orphanRemoval: true)]
    private Collection $institutTestOwnerships;

    public function __construct()
    {
        $this->institutMemberships = new ArrayCollection();
        $this->institutTestOwnerships = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->label;
    }
    public function setName(string $label): static
    {
        $this->label = $label;

        return $this;
    }

    public function getSiteweb(): ?string
    {
        return $this->siteweb;
    }

    public function setSiteweb(?string $siteweb): static
    {
        $this->siteweb = $siteweb;

        return $this;
    }

    public function getSocialNetworks(): ?array
    {
        return $this->socialNetworks;
    }

    public function setSocialNetworks(?array $socialNetworks): static
    {
        $this->socialNetworks = $socialNetworks;

        return $this;
    }

    public function getAddress1(): ?string
    {
        return $this->contactInfo->getAddress1();
    }
    public function setAddress1(?string $address1): static
    {
        $this->contactInfo->setAddress1($address1);
        return $this;
    }
    public function getAddress2(): ?string
    {
        return $this->contactInfo->getAddress2();
    }
    public function setAddress2(?string $address2): static
    {
        $this->contactInfo->setAddress2($address2);
        return $this;
    }

    public function getZipcode(): ?string
    {
        return $this->contactInfo->getZipcode();
    }

    public function setZipcode(string $zipcode) : static
    {
        $this->contactInfo->setZipcode($zipcode);
        return $this;
    }

    public function getCity(): ?string
    {
        return $this->contactInfo->getCity();
    }

    public function setCity(string $city) : static
    {
        $this->contactInfo->setCity($city);
        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->Country->getName();
    }
    public function setCountry(?Country $country): static
    {
        $this->Country = $country;

        return $this;
    }

    public function getStripeAccount(): ?StripeAccount
    {
        return $this->stripeAccount;
    }

    public function setStripeAccount(?StripeAccount $stripeAccount): static
    {
        $this->stripeAccount = $stripeAccount;

        return $this;
    }

    /**
     * @return Collection<int, InstitutMembership>
     */
    public function getInstitutMemberships(): Collection
    {
        return $this->institutMemberships;
    }

    public function addInstitutMembership(InstitutMembership $institutMembership): static
    {
        if (!$this->institutMemberships->contains($institutMembership)) {
            $this->institutMemberships->add($institutMembership);
            $institutMembership->setInstitut($this);
        }

        return $this;
    }

    public function removeInstitutMembership(InstitutMembership $institutMembership): static
    {
        if ($this->institutMemberships->removeElement($institutMembership)) {
            // set the owning side to null (unless already changed)
            if ($institutMembership->getInstitut() === $this) {
                $institutMembership->setInstitut(null);
            }
        }

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): static
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * @return Collection<int, InstitutTestOwnership>
     */
    public function getInstitutTestOwnerships(): Collection
    {
        return $this->institutTestOwnerships;
    }

    public function addInstitutTestOwnership(InstitutTestOwnership $institutTestOwnership): static
    {
        if (!$this->institutTestOwnerships->contains($institutTestOwnership)) {
            $this->institutTestOwnerships->add($institutTestOwnership);
            $institutTestOwnership->setInstitut($this);
        }

        return $this;
    }

    public function removeInstitutTestOwnership(InstitutTestOwnership $institutTestOwnership): static
    {
        if ($this->institutTestOwnerships->removeElement($institutTestOwnership)) {
            // set the owning side to null (unless already changed)
            if ($institutTestOwnership->getInstitut() === $this) {
                $institutTestOwnership->setInstitut(null);
            }
        }

        return $this;
    }

}
