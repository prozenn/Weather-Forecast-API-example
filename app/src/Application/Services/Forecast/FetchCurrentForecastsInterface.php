<?php

namespace App\Application\Services\Forecast;

use App\Domain\Address\Address;
use App\Domain\Forecast\Forecast;

interface FetchCurrentForecastsInterface
{
    public function fetch(Address $address): Forecast;
}