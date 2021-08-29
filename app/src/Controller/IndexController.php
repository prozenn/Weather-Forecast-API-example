<?php

namespace App\Controller;

use App\Application\Handler\Forecast\FetchCurrentForecastHandler;
use App\Application\Handler\Forecast\ListForecastsHandler;
use App\Domain\Address\Address;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class IndexController extends AbstractController
{
    public function __construct(
        private ListForecastsHandler        $listForecastsHandler,
        private FetchCurrentForecastHandler $fetchCurrentForecastHandler
    )
    {
    }

    public function index(Request $request): Response
    {
        $city = $request->get('city');
        $country = $request->get('country');
        $countryCode = $request->get('country_code');
        $currentTemp = null;
        $error = false;

        if ($city && $country) {
            $address = new Address($city, $country, $countryCode);

            try {
                $currentTemp = $this->fetchCurrentForecastHandler->handle($address);
            } catch (Exception $e) {
                $error = $e->getMessage();
            }
        }

        $forecasts = $this->listForecastsHandler->handle();

        return $this->render('index.html.twig', [
            'forecasts' => $forecasts,
            'currentTemp' => $currentTemp,
            'city' => $city,
            'country' => $country,
            'countryCode' => $countryCode,
            'error' => $error
        ]);
    }
}
