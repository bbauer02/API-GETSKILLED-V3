<?php
namespace App\Entity\Embeddable;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
#[ORM\Embeddable]
final class CounterParty
{
    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    private string $name;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $address1 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $address2 = null;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $zipcode = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $city = null;

    #[ORM\Column(length: 2, nullable: true)]
    #[Assert\Country]
    private ?string $country = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $vatNumber = null;

    public function __construct(
        string $name,
        ?string $address1 = null,
        ?string $address2 = null,
        ?string $zipcode = null,
        ?string $city = null,
        ?string $country = null,
        ?string $vatNumber = null,
    ) {
        $this->name = $name;
        $this->address1 = $address1;
        $this->address2 = $address2;
        $this->zipcode = $zipcode;
        $this->city = $city;
        $this->country = $country;
        $this->vatNumber = $vatNumber;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getAddress1(): ?string
    {
        return $this->address1;
    }

    public function getAddress2(): ?string
    {
        return $this->address2;
    }

    public function getZipcode(): ?string
    {
        return $this->zipcode;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function getVatNumber(): ?string
    {
        return $this->vatNumber;
    }
}
