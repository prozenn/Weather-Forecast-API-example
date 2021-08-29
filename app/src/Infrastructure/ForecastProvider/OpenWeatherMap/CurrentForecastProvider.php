<?php

namespace App\Infrastructure\ForecastProvider\OpenWeatherMap;

use App\Domain\Address\Address;
use App\Infrastructure\ForecastProvider\CurrentForecastProviderInterface;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class CurrentForecastProvider implements CurrentForecastProviderInterface
{
    private const API_ENDPOINT_URL = 'api.openweathermap.org/data/2.5/weather';

    public function __construct(
        protected string $apiKey,
        protected Client $client
    )
    {
    }

    public function fetch(Address $address): float
    {
        try {
            $response = $this->client->request('GET', self::API_ENDPOINT_URL, [
                'query' => [
                    'q' => str_replace(' ', '%20', $address->getAddress()),
                    'appid' => $this->apiKey,
                    'units' => 'metric'
                ]
            ]);
        } catch (RequestException $e) {
            $response = json_decode($e->getResponse()->getBody()->getContents());

            throw new Exception('Cannot fetch forecast from OpenWeatherMap: ' . $response->message);
        }

        if ($response->getStatusCode() !== 200) {
            throw new Exception('Cannot fetch forecast from OpenWeatherMap: ' . $response->getReasonPhrase());
        }

        $body = json_decode($response->getBody()->getContents());

        return $body->main->temp;
    }
}