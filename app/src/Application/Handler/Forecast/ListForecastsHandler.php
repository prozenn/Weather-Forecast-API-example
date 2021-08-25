<?php

namespace App\Application\Handler\Forecast;

use App\Domain\Forecast\ForecastRepositoryInterface;

class ListForecastsHandler
{
    public function __construct(
        private ForecastRepositoryInterface $forecastRepository
    )
    {
    }

    public function handle(): array
    {
        return $this->forecastRepository->getLatest();
    }
}