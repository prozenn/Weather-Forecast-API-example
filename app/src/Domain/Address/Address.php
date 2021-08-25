<?php

namespace App\Domain\Address;

class Address
{
    public function __construct(
        private string $city,
        private string $country
    )
    {
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function setCity(string $city): void
    {
        $this->city = $city;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function setCountry(string $country): void
    {
        $this->country = $country;
    }

    public function getAddress(): string
    {
        return $this->city . ', ' . $this->country;
    }
}