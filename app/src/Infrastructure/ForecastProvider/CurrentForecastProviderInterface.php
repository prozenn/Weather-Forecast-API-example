<?php

namespace App\Infrastructure\ForecastProvider;

use App\Domain\Address\Address;

interface CurrentForecastProviderInterface
{
    public function fetch(Address $address): float;
}