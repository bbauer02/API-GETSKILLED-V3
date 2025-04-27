<?php

namespace App\Interfaces;

use App\Entity\Embeddable\ContactInfo;

interface Contactable
{
public function getName(): ?string;
public function getAddress1(): ?string;
public function getAddress2(): ?string;
public function getZipcode(): ?string;
public function getCity(): ?string;
public function getCountry(): ?string;

}
