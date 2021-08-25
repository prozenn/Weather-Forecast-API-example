<?php

namespace App\Infrastructure\ForecastProvider\Random;

use App\Domain\Address\Address;
use App\Infrastructure\ForecastProvider\CurrentForecastProviderInterface;

class RandomCurrentForecastProvider implements CurrentForecastProviderInterface
{
    public function fetch(Address $address): float
    {
        return rand(0, 3000) / 100.0;
    }
}