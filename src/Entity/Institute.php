<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Entity\Embeddable\ContactInfo;
use App\Interfaces\Contactable;
use App\Repository\InstituteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InstituteRepository::class)]
#[ApiResource]
class Institute implements Contactable
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
     * @var Collection<int, InstituteMembership>
     */
    #[ORM\OneToMany(targetEntity: InstituteMembership::class, mappedBy: 'Institute', cascade: ['persist', 'remove'], orphanRemoval: true)]
    private Collection $InstituteMemberships;

    #[ORM\Column(length: 15, nullable: true)]
    private ?string $phone = null;

    /**
     * @var Collection<int, InstituteAssessmentOwnership>
     */
    #[ORM\OneToMany(targetEntity: InstituteAssessmentOwnership::class, mappedBy: 'institute', orphanRemoval: true)]
    private Collection $instituteAssessmentOwnerships;

    public function __construct()
    {
        $this->InstituteMemberships = new ArrayCollection();
        $this->instituteAssessmentOwnerships = new ArrayCollection();
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
     * @return Collection<int, InstituteMembership>
     */
    public function getInstituteMemberships(): Collection
    {
        return $this->InstituteMemberships;
    }

    public function addInstituteMembership(InstituteMembership $InstituteMembership): static
    {
        if (!$this->InstituteMemberships->contains($InstituteMembership)) {
            $this->InstituteMemberships->add($InstituteMembership);
            $InstituteMembership->setInstitute($this);
        }

        return $this;
    }

    public function removeInstituteMembership(InstituteMembership $InstituteMembership): static
    {
        if ($this->InstituteMemberships->removeElement($InstituteMembership)) {
            // set the owning side to null (unless already changed)
            if ($InstituteMembership->getInstitute() === $this) {
                $InstituteMembership->setInstitute(null);
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
     * @return Collection<int, InstituteAssessmentOwnership>
     */
    public function getInstituteAssessmentOwnerships(): Collection
    {
        return $this->instituteAssessmentOwnerships;
    }

    public function addInstituteAssessmentOwnership(InstituteAssessmentOwnership $instituteAssessmentOwnership): static
    {
        if (!$this->instituteAssessmentOwnerships->contains($instituteAssessmentOwnership)) {
            $this->instituteAssessmentOwnerships->add($instituteAssessmentOwnership);
            $instituteAssessmentOwnership->setInstitute($this);
        }

        return $this;
    }

    public function removeInstituteAssessmentOwnership(InstituteAssessmentOwnership $instituteAssessmentOwnership): static
    {
        if ($this->instituteAssessmentOwnerships->removeElement($instituteAssessmentOwnership)) {
            // set the owning side to null (unless already changed)
            if ($instituteAssessmentOwnership->getInstitute() === $this) {
                $instituteAssessmentOwnership->setInstitute(null);
            }
        }

        return $this;
    }



}
