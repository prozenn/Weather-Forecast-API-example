<?php

namespace App\Infrastructure\Service;

use App\Application\Services\Forecast\FetchCurrentForecastsInterface;
use App\Domain\Address\Address;
use App\Domain\Forecast\Forecast;
use App\Infrastructure\ForecastProvider\CurrentForecastProviderInterface;
use Exception;

class FetchCurrentForecasts implements FetchCurrentForecastsInterface
{
    public function __construct(
        private iterable $providers
    )
    {
    }

    public function fetch(Address $address): Forecast
    {
        $temperatureSum = 0.0;
        $count = 0;

        /** @var CurrentForecastProviderInterface $provider */
        foreach ($this->providers as $provider) {
            $temperatureSum += $provider->fetch($address);
            $count++;
        }

        if ($count > 0) {
            $temperature = $temperatureSum / $count;
        } else {
            throw new Exception('There is no current forecast provider');
        }

        return new Forecast(new \DateTime(), $temperature, $address);
    }
}