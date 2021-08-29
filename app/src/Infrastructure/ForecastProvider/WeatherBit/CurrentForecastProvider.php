<?php

namespace App\Infrastructure\ForecastProvider\WeatherBit;

use App\Domain\Address\Address;
use App\Infrastructure\ForecastProvider\CurrentForecastProviderInterface;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class CurrentForecastProvider implements CurrentForecastProviderInterface
{
    private const API_ENDPOINT_URL = 'http://api.weatherbit.io/v2.0/current';

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
                    'key' => $this->apiKey,
                    'city' => $address->getCity(),
                    'country' => $address->getCountryCode()
                ]
            ]);
        } catch (RequestException $e) {
            $response = json_decode($e->getResponse()->getBody()->getContents());

            throw new Exception('Cannot fetch forecast from WeatherBit: ' . $response->error);
        }

        if ($response->getStatusCode() !== 200) {
            throw new Exception('Cannot fetch forecast from WeatherBit: ' . $response->getReasonPhrase());
        }

        $body = json_decode($response->getBody()->getContents());

        return $body->data[0]->temp;
    }
}