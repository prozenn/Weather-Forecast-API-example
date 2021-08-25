<?php

namespace App\Domain\Forecast;

interface ForecastRepositoryInterface
{
    public function save(Forecast $forecast): void;

    public function getLatest(): array;
}