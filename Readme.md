# Simple forecast form API

This app shows how to get forecast data from several APIs.

## Implemented providers

Current providers:
- OpenWeatherMap
- WeatherBit

## How to add provider
To add next provider you need implement `CurrentForecastProviderInterface` and register it in `service.yml` with tag `provider.current_forecast`

## How to run project
1. `git clone git@github.com:prozenn/Weather-Forecast-API-example.git forecast`
2. `cd forecast`
3. Copy `.env` file to `.env.local` and add API keys
4. `docker-compose up`
5. Go to <localhost:8080>