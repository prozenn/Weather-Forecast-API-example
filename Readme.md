# Simple forecast form API

This app shows how to get forecast data from several APIs.

## Implemented providers

Current providers:
- OpenWeatherMap
- WeatherBit

## How to add provider
To add next provider you need implement `CurrentForecastProviderInterface` and register it in `service.yml` with tag `provider.current_forecast`