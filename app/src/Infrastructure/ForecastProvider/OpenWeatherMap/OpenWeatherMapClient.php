<?php

namespace App\Infrastructure\ForecastProvider\OpenWeatherMap;

abstract class OpenWeatherMapClient
{
    public function __construct(
        private string $apiKey
    )
    {
    }


}