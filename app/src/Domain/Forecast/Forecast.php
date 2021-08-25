<?php

namespace App\Domain\Forecast;

use App\Domain\Address\Address;
use DateTimeInterface;

class Forecast
{
    private int $id;

    public function __construct(
        private DateTimeInterface $dateTime,
        private float             $temperature,
        private string|Address    $address
    )
    {
        if ($this->address instanceof Address) {
            $this->setAddress($this->address);
        }
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getDateTime(): DateTimeInterface
    {
        return $this->dateTime;
    }

    public function setDateTime(DateTimeInterface $dateTime): void
    {
        $this->dateTime = $dateTime;
    }

    public function getTemperature(): float
    {
        return $this->temperature;
    }

    public function setTemperature(float $temperature): void
    {
        $this->temperature = $temperature;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function setAddress(Address $address): void
    {
        $this->address = $address->getAddress();
    }
}
