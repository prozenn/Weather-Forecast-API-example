<?php

namespace App\Application\Handler\Forecast;

use App\Application\Services\Forecast\FetchCurrentForecastsInterface;
use App\Domain\Address\Address;
use App\Domain\Forecast\ForecastRepositoryInterface;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;

class FetchCurrentForecastHandler
{
    public function __construct(
        private FetchCurrentForecastsInterface $fetchCurrentForecasts,
        private ForecastRepositoryInterface    $forecastRepository,
        private CacheInterface                 $cache
    )
    {
    }

    public function handle(Address $address): float
    {
        return $this->cache->get(str_replace(['(', ')'], '', $address->getAddress()), function (ItemInterface $item) use ($address) {
            $item->expiresAfter(60);

            $forecast = $this->fetchCurrentForecasts->fetch($address);
            $this->forecastRepository->save($forecast);

            return $forecast->getTemperature();
        });
    }
}